<?php
namespace Modules\Partner\Filament\Resources;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use A909M\FilamentStateFusion\Tables\Columns\StateFusionSelectColumn;
use A909M\FilamentStateFusion\Tables\Filters\StateFusionSelectFilter;
use App\Support\CountryCodeManager;
use BackedEnum;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingCustomFieldSchemaBuilder;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Modules\Partner\Filament\Resources\ListingResource\Pages;
use Modules\Video\Support\Filament\VideoFormSchema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function ($state, $set, ?Listing $record): void {
                    $baseSlug = \Illuminate\Support\Str::slug((string) $state);
                    $baseSlug = $baseSlug !== '' ? $baseSlug : 'listing';

                    $slug = $baseSlug;
                    $counter = 1;

                    while (Listing::query()
                        ->where('slug', $slug)
                        ->when($record, fn (Builder $query): Builder => $query->whereKeyNot($record->getKey()))
                        ->exists()) {
                        $slug = "{$baseSlug}-{$counter}";
                        $counter++;
                    }

                    $set('slug', $slug);
                }),
            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->readOnly()
                ->helperText('Slug is generated automatically from title.'),
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
                ->default(fn (): ?int => request()->integer('category_id') ?: null)
                ->searchable()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('custom_fields', []))
                ->nullable(),
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
            TextInput::make('contact_email')
                ->email()
                ->maxLength(255)
                ->default(fn (): ?string => Filament::auth()->user()?->email),
            Select::make('country')
                ->label('Country')
                ->options(fn (): array => Country::query()
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->pluck('name', 'name')
                    ->all())
                ->default(fn (): ?string => Country::query()
                    ->where('code', CountryCodeManager::defaultCountryIso2())
                    ->value('name'))
                ->searchable()
                ->preload()
                ->live()
                ->afterStateUpdated(fn ($state, $set) => $set('city', null))
                ->nullable(),
            Select::make('city')
                ->label('City')
                ->options(function (Get $get): array {
                    $country = $get('country');

                    if (blank($country)) {
                        return [];
                    }

                    return City::query()
                        ->where('is_active', true)
                        ->whereHas('country', fn (Builder $query): Builder => $query->where('name', $country))
                        ->orderBy('name')
                        ->pluck('name', 'name')
                        ->all();
                })
                ->searchable()
                ->preload()
                ->disabled(fn (Get $get): bool => blank($get('country')))
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
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('price')
                ->currency(fn (Listing $record): string => $record->currency ?: ListingPanelHelper::defaultCurrency())
                ->sortable(),
            StateFusionSelectColumn::make('status'),
            TextColumn::make('city'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->defaultSort('id', 'desc')->filters([
            StateFusionSelectFilter::make('status'),
            SelectFilter::make('category_id')
                ->label('Category')
                ->relationship('category', 'name')
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
        ])->actions([
            EditAction::make(),
            Action::make('activities')
                ->icon('heroicon-o-clock')
                ->url(fn (Listing $record): string => static::getUrl('activities', ['record' => $record])),
            DeleteAction::make(),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Filament::auth()->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'quick-create' => Pages\QuickCreateListing::route('/quick-create'),
            'activities' => Pages\ListListingActivities::route('/{record}/activities'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
