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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Admin\Filament\Resources\ListingResource\Pages;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Listing\Support\ListingPanelHelper;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;
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
            Select::make('category_id')->label('Category')->options(fn () => Category::where('is_active', true)->pluck('name', 'id'))->searchable()->nullable(),
            StateFusionSelect::make('status')->required(),
            PhoneInput::make('contact_phone')->defaultCountry(CountryCodeManager::defaultCountryIso2())->nullable(),
            TextInput::make('contact_email')->email()->maxLength(255),
            Toggle::make('is_featured')->default(false),
            TextInput::make('city')->maxLength(100),
            CountryCodeSelect::make('country')
                ->label('Country')
                ->default(fn () => CountryCodeManager::defaultCountryCode())
                ->formatStateUsing(fn ($state): ?string => CountryCodeManager::countryCodeFromLabelOrCode($state))
                ->dehydrateStateUsing(fn ($state, ?Listing $record): ?string => CountryCodeManager::normalizeStoredCountry($state ?? $record?->country)),
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
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('price')
                ->currency(fn (Listing $record): string => $record->currency ?: ListingPanelHelper::defaultCurrency())
                ->sortable(),
            StateFusionSelectColumn::make('status'),
            IconColumn::make('is_featured')->boolean()->label('Featured'),
            TextColumn::make('city'),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            StateFusionSelectFilter::make('status'),
        ])->actions([
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
