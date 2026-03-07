<?php

namespace Modules\Admin\Filament\Pages;

use App\Support\HomeSlideDefaults;
use App\Support\CountryCodeManager;
use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Modules\Admin\Support\HomeSlideFormSchema;
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $defaults = $this->defaultFormData();

        return [
            'site_name' => filled($data['site_name'] ?? null) ? $data['site_name'] : $defaults['site_name'],
            'site_description' => filled($data['site_description'] ?? null) ? $data['site_description'] : $defaults['site_description'],
            'home_slides' => $this->normalizeHomeSlides($data['home_slides'] ?? $defaults['home_slides']),
            'site_logo' => $data['site_logo'] ?? null,
            'sender_name' => filled($data['sender_name'] ?? null) ? $data['sender_name'] : $defaults['sender_name'],
            'sender_email' => filled($data['sender_email'] ?? null) ? $data['sender_email'] : $defaults['sender_email'],
            'default_language' => filled($data['default_language'] ?? null) ? $data['default_language'] : $defaults['default_language'],
            'default_country_code' => filled($data['default_country_code'] ?? null) ? $data['default_country_code'] : $defaults['default_country_code'],
            'currencies' => $this->normalizeCurrencies($data['currencies'] ?? $defaults['currencies']),
            'linkedin_url' => filled($data['linkedin_url'] ?? null) ? $data['linkedin_url'] : $defaults['linkedin_url'],
            'instagram_url' => filled($data['instagram_url'] ?? null) ? $data['instagram_url'] : $defaults['instagram_url'],
            'whatsapp' => filled($data['whatsapp'] ?? null) ? $data['whatsapp'] : $defaults['whatsapp'],
            'enable_google_maps' => (bool) ($data['enable_google_maps'] ?? $defaults['enable_google_maps']),
            'google_maps_api_key' => $data['google_maps_api_key'] ?? null,
            'enable_google_login' => (bool) ($data['enable_google_login'] ?? $defaults['enable_google_login']),
            'google_client_id' => $data['google_client_id'] ?? null,
            'google_client_secret' => $data['google_client_secret'] ?? null,
            'enable_facebook_login' => (bool) ($data['enable_facebook_login'] ?? $defaults['enable_facebook_login']),
            'facebook_client_id' => $data['facebook_client_id'] ?? null,
            'facebook_client_secret' => $data['facebook_client_secret'] ?? null,
            'enable_apple_login' => (bool) ($data['enable_apple_login'] ?? $defaults['enable_apple_login']),
            'apple_client_id' => $data['apple_client_id'] ?? null,
            'apple_client_secret' => $data['apple_client_secret'] ?? null,
        ];
    }

    public function form(Schema $schema): Schema
    {
        $defaults = $this->defaultFormData();

        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Site Adı')
                    ->default($defaults['site_name'])
                    ->required()
                    ->maxLength(255),
                Textarea::make('site_description')
                    ->label('Site Açıklaması')
                    ->default($defaults['site_description'])
                    ->rows(3)
                    ->maxLength(500),
                HomeSlideFormSchema::make(
                    $defaults['home_slides'],
                    fn ($state): array => $this->normalizeHomeSlides($state),
                ),
                FileUpload::make('site_logo')
                    ->label('Site Logosu')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public'),
                TextInput::make('sender_name')
                    ->label('Gönderici Adı')
                    ->default($defaults['sender_name'])
                    ->required()
                    ->maxLength(120),
                TextInput::make('sender_email')
                    ->label('Gönderici E-postası')
                    ->email()
                    ->default($defaults['sender_email'])
                    ->required()
                    ->maxLength(255),
                Select::make('default_language')
                    ->label('Varsayılan Dil')
                    ->options($this->localeOptions())
                    ->default($defaults['default_language'])
                    ->required()
                    ->searchable(),
                CountryCodeSelect::make('default_country_code')
                    ->label('Varsayılan Ülke')
                    ->default($defaults['default_country_code'])
                    ->required()
                    ->helperText('Panel formlarında varsayılan ülke olarak kullanılır.'),
                TagsInput::make('currencies')
                    ->label('Para Birimleri')
                    ->placeholder('TRY')
                    ->default($defaults['currencies'])
                    ->helperText('TRY, USD, EUR gibi 3 harfli para birimi kodları ekleyin.')
                    ->required()
                    ->rules(['array', 'min:1'])
                    ->afterStateHydrated(fn (TagsInput $component, $state) => $component->state($this->normalizeCurrencies($state)))
                    ->dehydrateStateUsing(fn ($state) => $this->normalizeCurrencies($state)),
                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url()
                    ->default($defaults['linkedin_url'])
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->url()
                    ->default($defaults['instagram_url'])
                    ->nullable()
                    ->maxLength(255),
                PhoneInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->defaultCountry(CountryCodeManager::defaultCountryIso2())
                    ->default($defaults['whatsapp'])
                    ->nullable()
                    ->formatAsYouType()
                    ->helperText('Uluslararası format kullanın. Örnek: +905551112233'),
                Toggle::make('enable_google_maps')
                    ->label('Google Maps Aktif')
                    ->default($defaults['enable_google_maps']),
                TextInput::make('google_maps_api_key')
                    ->label('Google Maps API Anahtarı')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255)
                    ->helperText('İlan formlarındaki harita alanlarını açmak için gereklidir.'),
                Toggle::make('enable_google_login')
                    ->label('Google ile Giriş Aktif')
                    ->default($defaults['enable_google_login']),
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
                    ->default($defaults['enable_facebook_login']),
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
                    ->default($defaults['enable_apple_login']),
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

    private function defaultFormData(): array
    {
        $siteName = (string) config('app.name', 'OpenClassify');
        $siteHost = parse_url((string) config('app.url', 'https://oc2.test'), PHP_URL_HOST) ?: 'oc2.test';

        return [
            'site_name' => $siteName,
            'site_description' => 'Alim satim icin hizli ve guvenli ilan platformu.',
            'home_slides' => $this->defaultHomeSlides(),
            'sender_name' => $siteName,
            'sender_email' => (string) config('mail.from.address', 'info@' . $siteHost),
            'default_language' => in_array(config('app.locale'), array_keys($this->localeOptions()), true) ? (string) config('app.locale') : 'tr',
            'default_country_code' => CountryCodeManager::normalizeCountryCode(config('app.default_country_code', '+90')),
            'currencies' => $this->normalizeCurrencies(config('app.currencies', ['TRY'])),
            'linkedin_url' => 'https://www.linkedin.com/company/openclassify',
            'instagram_url' => 'https://www.instagram.com/openclassify',
            'whatsapp' => '+905551112233',
            'enable_google_maps' => false,
            'enable_google_login' => false,
            'enable_facebook_login' => false,
            'enable_apple_login' => false,
        ];
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
