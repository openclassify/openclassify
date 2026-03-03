<?php

namespace App\Providers;

use App\Support\CountryCodeManager;
use App\Settings\GeneralSettings;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::addNamespace('app', resource_path('views'));

        $fallbackName = config('app.name', 'OpenClassify');
        $fallbackLocale = config('app.locale', 'en');
        $fallbackCurrencies = $this->normalizeCurrencies(config('app.currencies', ['USD']));
        $fallbackDescription = 'The marketplace for buying and selling everything.';
        $fallbackGoogleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        $fallbackGoogleClientId = env('GOOGLE_CLIENT_ID');
        $fallbackGoogleClientSecret = env('GOOGLE_CLIENT_SECRET');
        $fallbackFacebookClientId = env('FACEBOOK_CLIENT_ID');
        $fallbackFacebookClientSecret = env('FACEBOOK_CLIENT_SECRET');
        $fallbackAppleClientId = env('APPLE_CLIENT_ID');
        $fallbackAppleClientSecret = env('APPLE_CLIENT_SECRET');
        $fallbackDefaultCountryCode = '+90';

        $generalSettings = [
            'site_name' => $fallbackName,
            'site_description' => $fallbackDescription,
            'site_logo_url' => null,
            'default_language' => $fallbackLocale,
            'default_country_code' => $fallbackDefaultCountryCode,
            'currencies' => $fallbackCurrencies,
            'sender_email' => config('mail.from.address', 'hello@example.com'),
            'sender_name' => config('mail.from.name', $fallbackName),
            'linkedin_url' => null,
            'instagram_url' => null,
            'whatsapp' => null,
            'google_maps_enabled' => false,
            'google_maps_api_key' => $fallbackGoogleMapsApiKey,
            'google_login_enabled' => (bool) env('ENABLE_GOOGLE_LOGIN', false),
            'google_client_id' => $fallbackGoogleClientId,
            'google_client_secret' => $fallbackGoogleClientSecret,
            'facebook_login_enabled' => (bool) env('ENABLE_FACEBOOK_LOGIN', false),
            'facebook_client_id' => $fallbackFacebookClientId,
            'facebook_client_secret' => $fallbackFacebookClientSecret,
            'apple_login_enabled' => (bool) env('ENABLE_APPLE_LOGIN', false),
            'apple_client_id' => $fallbackAppleClientId,
            'apple_client_secret' => $fallbackAppleClientSecret,
        ];

        $hasSettingsTable = false;

        try {
            $hasSettingsTable = Schema::hasTable('settings');
        } catch (Throwable) {
            $hasSettingsTable = false;
        }

        if ($hasSettingsTable) {
            try {
                $settings = app(GeneralSettings::class);
                $currencies = $this->normalizeCurrencies($settings->currencies ?? $fallbackCurrencies);
                $availableLocales = config('app.available_locales', ['en']);
                $defaultLanguage = in_array($settings->default_language, $availableLocales, true)
                    ? $settings->default_language
                    : $fallbackLocale;
                $googleMapsApiKey = trim((string) ($settings->google_maps_api_key ?: $fallbackGoogleMapsApiKey));
                $googleMapsApiKey = $googleMapsApiKey !== '' ? $googleMapsApiKey : null;
                $googleClientId = trim((string) ($settings->google_client_id ?: $fallbackGoogleClientId));
                $googleClientSecret = trim((string) ($settings->google_client_secret ?: $fallbackGoogleClientSecret));
                $facebookClientId = trim((string) ($settings->facebook_client_id ?: $fallbackFacebookClientId));
                $facebookClientSecret = trim((string) ($settings->facebook_client_secret ?: $fallbackFacebookClientSecret));
                $appleClientId = trim((string) ($settings->apple_client_id ?: $fallbackAppleClientId));
                $appleClientSecret = trim((string) ($settings->apple_client_secret ?: $fallbackAppleClientSecret));
                $defaultCountryCode = CountryCodeManager::normalizeCountryCode($settings->default_country_code ?? $fallbackDefaultCountryCode);

                $generalSettings = [
                    'site_name' => trim((string) ($settings->site_name ?: $fallbackName)),
                    'site_description' => trim((string) ($settings->site_description ?: $fallbackDescription)),
                    'site_logo_url' => filled($settings->site_logo)
                        ? Storage::disk('public')->url($settings->site_logo)
                        : null,
                    'default_language' => $defaultLanguage,
                    'default_country_code' => $defaultCountryCode,
                    'currencies' => $currencies,
                    'sender_email' => trim((string) ($settings->sender_email ?: config('mail.from.address'))),
                    'sender_name' => trim((string) ($settings->sender_name ?: $fallbackName)),
                    'linkedin_url' => $settings->linkedin_url ?: null,
                    'instagram_url' => $settings->instagram_url ?: null,
                    'whatsapp' => $settings->whatsapp ?: null,
                    'google_maps_enabled' => (bool) ($settings->enable_google_maps ?? false),
                    'google_maps_api_key' => $googleMapsApiKey,
                    'google_login_enabled' => (bool) ($settings->enable_google_login ?? false),
                    'google_client_id' => $googleClientId !== '' ? $googleClientId : null,
                    'google_client_secret' => $googleClientSecret !== '' ? $googleClientSecret : null,
                    'facebook_login_enabled' => (bool) ($settings->enable_facebook_login ?? false),
                    'facebook_client_id' => $facebookClientId !== '' ? $facebookClientId : null,
                    'facebook_client_secret' => $facebookClientSecret !== '' ? $facebookClientSecret : null,
                    'apple_login_enabled' => (bool) ($settings->enable_apple_login ?? false),
                    'apple_client_id' => $appleClientId !== '' ? $appleClientId : null,
                    'apple_client_secret' => $appleClientSecret !== '' ? $appleClientSecret : null,
                ];

                config([
                    'app.name' => $generalSettings['site_name'],
                    'app.locale' => $generalSettings['default_language'],
                    'app.currencies' => $generalSettings['currencies'],
                    'mail.from.address' => $generalSettings['sender_email'],
                    'mail.from.name' => $generalSettings['sender_name'],
                ]);
            } catch (Throwable) {
                config(['app.currencies' => $fallbackCurrencies]);
            }
        } else {
            config(['app.currencies' => $fallbackCurrencies]);
        }

        $mapsKey = $generalSettings['google_maps_enabled']
            ? $generalSettings['google_maps_api_key']
            : null;

        config([
            'filament-google-maps.key' => $mapsKey,
            'filament-google-maps.keys.web_key' => $mapsKey,
            'filament-google-maps.keys.server_key' => $mapsKey,
            'services.google.client_id' => $generalSettings['google_client_id'],
            'services.google.client_secret' => $generalSettings['google_client_secret'],
            'services.google.redirect' => url('/oauth/callback/google'),
            'services.google.enabled' => (bool) $generalSettings['google_login_enabled'],
            'services.facebook.client_id' => $generalSettings['facebook_client_id'],
            'services.facebook.client_secret' => $generalSettings['facebook_client_secret'],
            'services.facebook.redirect' => url('/oauth/callback/facebook'),
            'services.facebook.enabled' => (bool) $generalSettings['facebook_login_enabled'],
            'services.apple.client_id' => $generalSettings['apple_client_id'],
            'services.apple.client_secret' => $generalSettings['apple_client_secret'],
            'services.apple.redirect' => url('/oauth/callback/apple'),
            'services.apple.stateless' => true,
            'services.apple.enabled' => (bool) $generalSettings['apple_login_enabled'],
            'money.defaults.currency' => $generalSettings['currencies'][0] ?? 'USD',
            'app.default_country_code' => $generalSettings['default_country_code'] ?? $fallbackDefaultCountryCode,
            'app.default_country_iso2' => CountryCodeManager::iso2FromCountryCode($generalSettings['default_country_code'] ?? $fallbackDefaultCountryCode) ?? 'TR',
        ]);

        Event::listen(function (SocialiteWasCalled $event): void {
            $event->extendSocialite('apple', \SocialiteProviders\Apple\Provider::class);
        });

        $availableLocales = config('app.available_locales', ['en']);
        $localeLabels = [
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

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) use ($availableLocales, $localeLabels): void {
            $switch
                ->locales($availableLocales)
                ->labels(collect($availableLocales)->mapWithKeys(
                    fn (string $locale) => [$locale => $localeLabels[$locale] ?? strtoupper($locale)]
                )->all())
                ->visible(insidePanels: count($availableLocales) > 1, outsidePanels: false);
        });

        View::share('generalSettings', $generalSettings);
    }

    private function normalizeCurrencies(array $currencies): array
    {
        $normalized = collect($currencies)
            ->filter(fn ($currency) => is_string($currency) && trim($currency) !== '')
            ->map(fn (string $currency) => strtoupper(substr(trim($currency), 0, 3)))
            ->filter(fn (string $currency) => strlen($currency) === 3)
            ->unique()
            ->values()
            ->all();

        return $normalized !== [] ? $normalized : ['USD'];
    }
}
