<?php

namespace Modules\Admin\Filament\Pages;

use App\Support\HomeSlideDefaults;
use App\Support\CountryCodeManager;
use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Tapp\FilamentCountryCodeField\Forms\Components\CountryCodeSelect;
use UnitEnum;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class ManageGeneralSettings extends SettingsPage
{
    protected static string $settings = GeneralSettings::class;

    protected static ?string $title = 'Genel Ayarlar';

    protected static ?string $navigationLabel = 'Genel Ayarlar';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = 'Ayarlar';

    protected static ?int $navigationSort = 1;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Site Adı')
                    ->required()
                    ->maxLength(255),
                Textarea::make('site_description')
                    ->label('Site Açıklaması')
                    ->rows(3)
                    ->maxLength(500),
                Repeater::make('home_slides')
                    ->label('Ana Sayfa Slider')
                    ->schema([
                        TextInput::make('badge')
                            ->label('Rozet')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('subtitle')
                            ->label('Alt Başlık')
                            ->rows(2)
                            ->required()
                            ->maxLength(500),
                        TextInput::make('primary_button_text')
                            ->label('Birincil Buton Metni')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('secondary_button_text')
                            ->label('İkincil Buton Metni')
                            ->required()
                            ->maxLength(120),
                    ])
                    ->default($this->defaultHomeSlides())
                    ->minItems(1)
                    ->collapsible()
                    ->reorderableWithButtons()
                    ->addActionLabel('Slide Ekle')
                    ->itemLabel(fn (array $state): ?string => filled($state['title'] ?? null) ? (string) $state['title'] : 'Slide')
                    ->afterStateHydrated(fn (Repeater $component, $state) => $component->state($this->normalizeHomeSlides($state)))
                    ->dehydrateStateUsing(fn ($state) => $this->normalizeHomeSlides($state)),
                FileUpload::make('site_logo')
                    ->label('Site Logosu')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public'),
                TextInput::make('sender_name')
                    ->label('Gönderici Adı')
                    ->required()
                    ->maxLength(120),
                TextInput::make('sender_email')
                    ->label('Gönderici E-postası')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Select::make('default_language')
                    ->label('Varsayılan Dil')
                    ->options($this->localeOptions())
                    ->required()
                    ->searchable(),
                CountryCodeSelect::make('default_country_code')
                    ->label('Varsayılan Ülke')
                    ->default('+90')
                    ->required()
                    ->helperText('Panel formlarında varsayılan ülke olarak kullanılır.'),
                TagsInput::make('currencies')
                    ->label('Para Birimleri')
                    ->placeholder('TRY')
                    ->helperText('TRY, USD, EUR gibi 3 harfli para birimi kodları ekleyin.')
                    ->required()
                    ->rules(['array', 'min:1'])
                    ->afterStateHydrated(fn (TagsInput $component, $state) => $component->state($this->normalizeCurrencies($state)))
                    ->dehydrateStateUsing(fn ($state) => $this->normalizeCurrencies($state)),
                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url()
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->url()
                    ->nullable()
                    ->maxLength(255),
                PhoneInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->defaultCountry(CountryCodeManager::defaultCountryIso2())
                    ->nullable()
                    ->formatAsYouType()
                    ->helperText('Uluslararası format kullanın. Örnek: +905551112233'),
                Toggle::make('enable_google_maps')
                    ->label('Google Maps Aktif')
                    ->default(false),
                TextInput::make('google_maps_api_key')
                    ->label('Google Maps API Anahtarı')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255)
                    ->helperText('İlan formlarındaki harita alanlarını açmak için gereklidir.'),
                Toggle::make('enable_google_login')
                    ->label('Google ile Giriş Aktif')
                    ->default(false),
                TextInput::make('google_client_id')
                    ->label('Google Client ID')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('google_client_secret')
                    ->label('Google Client Secret')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255),
                Toggle::make('enable_facebook_login')
                    ->label('Facebook ile Giriş Aktif')
                    ->default(false),
                TextInput::make('facebook_client_id')
                    ->label('Facebook Client ID')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('facebook_client_secret')
                    ->label('Facebook Client Secret')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255),
                Toggle::make('enable_apple_login')
                    ->label('Apple ile Giriş Aktif')
                    ->default(false),
                TextInput::make('apple_client_id')
                    ->label('Apple Client ID')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('apple_client_secret')
                    ->label('Apple Client Secret')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    private function localeOptions(): array
    {
        $labels = [
            'en' => 'English',
            'tr' => 'Türkçe',
        ];

        return collect(config('app.available_locales', ['en']))
            ->mapWithKeys(fn (string $locale) => [$locale => $labels[$locale] ?? strtoupper($locale)])
            ->all();
    }

    private function normalizeCurrencies(null | array | string $state): array
    {
        $source = is_array($state) ? $state : (filled($state) ? [$state] : []);

        $normalized = collect($source)
            ->filter(fn ($currency) => is_string($currency) && trim($currency) !== '')
            ->map(fn (string $currency) => strtoupper(substr(trim($currency), 0, 3)))
            ->filter(fn (string $currency) => strlen($currency) === 3)
            ->unique()
            ->values()
            ->all();

        return $normalized !== [] ? $normalized : ['USD'];
    }

    private function defaultHomeSlides(): array
    {
        return HomeSlideDefaults::defaults();
    }

    private function normalizeHomeSlides(mixed $state): array
    {
        return HomeSlideDefaults::normalize($state);
    }
}
