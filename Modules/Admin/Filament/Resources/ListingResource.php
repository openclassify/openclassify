<?php
namespace Modules\Admin\Filament\Resources;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use A909M\FilamentStateFusion\Tables\Columns\StateFusionSelectColumn;
use A909M\FilamentStateFusion\Tables\Filters\StateFusionSelectFilter;
use App\Support\CountryCodeManager;
use BackedEnum;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Admin\Filament\Resources\ListingResource\Pages;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\Video\Support\Filament\VideoFormSchema;
use UnitEnum;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string | UnitEnum | null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state) . '-' . \Illuminate\Support\Str::random(4))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(4),
            TextInput::make('price')
                ->numeric()
                ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2),
            Select::make('currency')
                ->options(fn () => ListingPanelHelper::currencyOptions())
                ->default(fn () => ListingPanelHelper::defaultCurrency())
                ->required(),
            Select::make('category_id')
                ->label('Category')
                ->options(fn () => Category::where('is_active', true)->pluck('name', 'id'))
                ->searchable()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('custom_fields', []))
                ->nullable(),
            Select::make('user_id')->relationship('user', 'email')->label('Owner')->searchable()->preload()->nullable(),
            Section::make('Custom Fields')
                ->description('Category specific listing attributes.')
                ->schema(fn (Get $get): array => ListingCustomFieldSchemaBuilder::formComponents(
                    ($categoryId = $get('category_id')) ? (int) $categoryId : null
                ))
                ->columns(2)
                ->columnSpanFull()
                ->visible(fn (Get $get): bool => ListingCustomFieldSchemaBuilder::hasFields(
                    ($categoryId = $get('category_id')) ? (int) $categoryId : null
                )),
            StateFusionSelect::make('status')->required(),
            PhoneInput::make('contact_phone')->defaultCountry(CountryCodeManager::defaultCountryIso2())->nullable(),
            TextInput::make('contact_email')->email()->maxLength(255),
            Toggle::make('is_featured')->default(false),
            Select::make('country')
                ->label('Country')
                ->options(fn (): array => Country::query()
                    ->orderBy('name')
                    ->pluck('name', 'name')
                    ->all())
                ->searchable()
                ->preload()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('city', null))
                ->nullable(),
            Select::make('city')
                ->label('City')
                ->options(function (Get $get): array {
                    $country = $get('country');

                    return City::query()
                        ->where('is_active', true)
                        ->when($country, fn (Builder $query, string $country): Builder => $query->whereHas('country', fn (Builder $countryQuery): Builder => $countryQuery->where('name', $country)))
                        ->orderBy('name')
                        ->pluck('name', 'name')
                        ->all();
                })
                ->searchable()
                ->preload()
                ->nullable(),
            Map::make('location')
                ->label('Location')
                ->visible(fn (): bool => ListingPanelHelper::googleMapsEnabled())
                ->draggable()
                ->clickable()
                ->autocomplete('city')
                ->autocompleteReverse(true)
                ->reverseGeocode([
                    'city' => '%L',
                ])
                ->defaultLocation([41.0082, 28.9784])
                ->defaultZoom(10)
                ->height('320px')
                ->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('images')
                ->collection('listing-images')
                ->multiple()
                ->image()
                ->reorderable(),
            VideoFormSchema::listingSection(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            SpatieMediaLibraryImageColumn::make('images')
                ->collection('listing-images')
                ->circular(),
            TextColumn::make('id')->sortable(),
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category.name')->label('Category')->sortable(),
            TextColumn::make('user.email')->label('Owner')->searchable()->toggleable()->sortable(),
            TextColumn::make('price')
                ->currency(fn (Listing $record): string => $record->currency ?: ListingPanelHelper::defaultCurrency())
                ->sortable(),
            StateFusionSelectColumn::make('status')->sortable(),
            IconColumn::make('is_featured')->boolean()->label('Featured')->sortable(),
            TextColumn::make('city')->sortable(),
            TextColumn::make('country')->sortable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            StateFusionSelectFilter::make('status'),
            SelectFilter::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->searchable()
                ->preload(),
            SelectFilter::make('user_id')
                ->label('Owner')
                ->relationship('user', 'email')
                ->searchable()
                ->preload(),
            SelectFilter::make('country')
                ->options(fn (): array => Country::query()
                    ->orderBy('name')
                    ->pluck('name', 'name')
                    ->all())
                ->searchable(),
            SelectFilter::make('city')
                ->options(fn (): array => City::query()
                    ->orderBy('name')
                    ->pluck('name', 'name')
                    ->all())
                ->searchable(),
            TernaryFilter::make('is_featured')->label('Featured'),
            Filter::make('created_at')
                ->label('Created Date')
                ->schema([
                    DatePicker::make('from')->label('From'),
                    DatePicker::make('until')->label('Until'),
                ])
                ->query(fn (Builder $query, array $data): Builder => $query
                    ->when($data['from'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '>=', $date))
                    ->when($data['until'] ?? null, fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '<=', $date))),
            Filter::make('price')
                ->label('Price Range')
                ->schema([
                    TextInput::make('min')->numeric()->label('Min'),
                    TextInput::make('max')->numeric()->label('Max'),
                ])
                ->query(fn (Builder $query, array $data): Builder => $query
                    ->when($data['min'] ?? null, fn (Builder $query, string $amount): Builder => $query->where('price', '>=', (float) $amount))
                    ->when($data['max'] ?? null, fn (Builder $query, string $amount): Builder => $query->where('price', '<=', (float) $amount))),
        ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filtersFormColumns(3)
            ->filtersFormWidth('7xl')
            ->persistFiltersInSession()
            ->defaultSort('id', 'desc')
            ->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (Listing $record): string => static::getUrl('activities', ['record' => $record])),
            DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'activities' => Pages\ListListingActivities::route('/{record}/activities'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
