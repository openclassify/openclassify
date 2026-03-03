<?php
namespace Modules\Partner\Filament\Resources;

use A909M\FilamentStateFusion\Forms\Components\StateFusionSelect;
use A909M\FilamentStateFusion\Tables\Columns\StateFusionSelectColumn;
use A909M\FilamentStateFusion\Tables\Filters\StateFusionSelectFilter;
use App\Settings\GeneralSettings;
use BackedEnum;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Category\Models\Category;
use Modules\Listing\Models\Listing;
use Modules\Partner\Filament\Resources\ListingResource\Pages;
use Throwable;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')->required()->maxLength(255)->live(onBlur: true)->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state) . '-' . \Illuminate\Support\Str::random(4))),
            TextInput::make('slug')->required()->maxLength(255)->unique(ignoreRecord: true),
            Textarea::make('description')->rows(4),
            TextInput::make('price')->numeric()->prefix('$'),
            Select::make('currency')
                ->options(fn () => self::currencyOptions())
                ->default(fn () => self::defaultCurrency())
                ->required(),
            Select::make('category_id')->label('Category')->options(fn () => Category::where('is_active', true)->pluck('name', 'id'))->searchable()->nullable(),
            StateFusionSelect::make('status')->required(),
            PhoneInput::make('contact_phone')->defaultCountry('TR')->nullable(),
            TextInput::make('contact_email')->email()->maxLength(255),
            TextInput::make('city')->maxLength(100),
            TextInput::make('country')->maxLength(100),
            Map::make('location')
                ->label('Location')
                ->visible(fn (): bool => self::googleMapsEnabled())
                ->draggable()
                ->clickable()
                ->autocomplete('city')
                ->autocompleteReverse(true)
                ->reverseGeocode([
                    'city' => '%L',
                    'country' => '%C',
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
            TextColumn::make('title')->searchable()->sortable()->limit(40),
            TextColumn::make('category.name')->label('Category'),
            TextColumn::make('price')->money('USD')->sortable(),
            StateFusionSelectColumn::make('status'),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Filament::auth()->id());
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

    private static function currencyOptions(): array
    {
        $codes = collect(config('app.currencies', ['USD']))
            ->filter(fn ($code) => is_string($code) && trim($code) !== '')
            ->map(fn (string $code) => strtoupper(substr(trim($code), 0, 3)))
            ->filter(fn (string $code) => strlen($code) === 3)
            ->unique()
            ->values()
            ->all();

        if ($codes === []) {
            $codes = ['USD'];
        }

        return collect($codes)->mapWithKeys(fn (string $code) => [$code => $code])->all();
    }

    private static function defaultCurrency(): string
    {
        return array_key_first(self::currencyOptions()) ?? 'USD';
    }

    private static function googleMapsEnabled(): bool
    {
        try {
            return (bool) app(GeneralSettings::class)->enable_google_maps;
        } catch (Throwable) {
            return false;
        }
    }
}
