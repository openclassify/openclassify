<?php

namespace Modules\Admin\Filament\Pages;

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

    protected static ?string $title = 'General Settings';

    protected static ?string $navigationLabel = 'General Settings';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Site Name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('site_description')
                    ->label('Site Description')
                    ->rows(3)
                    ->maxLength(500),
                Repeater::make('home_slides')
                    ->label('Home Slider')
                    ->schema([
                        TextInput::make('badge')
                            ->label('Badge')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('subtitle')
                            ->label('Subtitle')
                            ->rows(2)
                            ->required()
                            ->maxLength(500),
                        TextInput::make('primary_button_text')
                            ->label('Primary Button Text')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('secondary_button_text')
                            ->label('Secondary Button Text')
                            ->required()
                            ->maxLength(120),
                    ])
                    ->default($this->defaultHomeSlides())
                    ->minItems(1)
                    ->collapsible()
                    ->reorderableWithButtons()
                    ->addActionLabel('Add Slide')
                    ->itemLabel(fn (array $state): ?string => filled($state['title'] ?? null) ? (string) $state['title'] : 'Slide')
                    ->afterStateHydrated(fn (Repeater $component, $state) => $component->state($this->normalizeHomeSlides($state)))
                    ->dehydrateStateUsing(fn ($state) => $this->normalizeHomeSlides($state)),
                FileUpload::make('site_logo')
                    ->label('Site Logo')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public'),
                TextInput::make('sender_name')
                    ->label('Sender Name')
                    ->required()
                    ->maxLength(120),
                TextInput::make('sender_email')
                    ->label('Sender Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Select::make('default_language')
                    ->label('Default Language')
                    ->options($this->localeOptions())
                    ->required()
                    ->searchable(),
                CountryCodeSelect::make('default_country_code')
                    ->label('Default Country')
                    ->default('+90')
                    ->required()
                    ->helperText('Used as default country in panel forms.'),
                TagsInput::make('currencies')
                    ->label('Currencies')
                    ->placeholder('USD')
                    ->helperText('Add 3-letter currency codes like USD, EUR, TRY.')
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
                    ->helperText('Use international format, e.g. +905551112233.'),
                Toggle::make('enable_google_maps')
                    ->label('Enable Google Maps')
                    ->default(false),
                TextInput::make('google_maps_api_key')
                    ->label('Google Maps API Key')
                    ->password()
                    ->revealable()
                    ->nullable()
                    ->maxLength(255)
                    ->helperText('Required to enable map fields in listing forms.'),
                Toggle::make('enable_google_login')
                    ->label('Enable Google Login')
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
                    ->label('Enable Facebook Login')
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
                    ->label('Enable Apple Login')
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
            'ar' => 'العربية',
            'zh' => '中文',
            'es' => 'Español',
            'fr' => 'Français',
            'de' => 'Deutsch',
            'pt' => 'Português',
            'ru' => 'Русский',
            'ja' => '日本語',
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
        return [
            [
                'badge' => 'OpenClassify Marketplace',
                'title' => 'İlan ücreti ödemeden ürününü hızla sat!',
                'subtitle' => 'Buy and sell everything in your area',
                'primary_button_text' => 'İncele',
                'secondary_button_text' => 'Post Listing',
            ],
        ];
    }

    private function normalizeHomeSlides(mixed $state): array
    {
        $slides = is_array($state) ? $state : [];
        $fallbackSlide = $this->defaultHomeSlides()[0];

        $normalized = collect($slides)
            ->filter(fn ($slide): bool => is_array($slide))
            ->map(function (array $slide) use ($fallbackSlide): ?array {
                $badge = trim((string) ($slide['badge'] ?? ''));
                $title = trim((string) ($slide['title'] ?? ''));
                $subtitle = trim((string) ($slide['subtitle'] ?? ''));
                $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
                $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));

                if ($title === '') {
                    return null;
                }

                return [
                    'badge' => $badge !== '' ? $badge : $fallbackSlide['badge'],
                    'title' => $title,
                    'subtitle' => $subtitle !== '' ? $subtitle : $fallbackSlide['subtitle'],
                    'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : $fallbackSlide['primary_button_text'],
                    'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : $fallbackSlide['secondary_button_text'],
                ];
            })
            ->filter(fn ($slide): bool => is_array($slide))
            ->values()
            ->all();

        return $normalized !== [] ? $normalized : $this->defaultHomeSlides();
    }
}
