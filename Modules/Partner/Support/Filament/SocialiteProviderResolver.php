<?php

namespace Modules\Partner\Support\Filament;

use App\Settings\GeneralSettings;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Support\Colors\Color;
use Throwable;

class SocialiteProviderResolver
{
    public static function providers(): array
    {
        $providers = [];

        if (self::enabled('google')) {
            $providers[] = Provider::make('google')
                ->label('Google')
                ->icon('heroicon-o-globe-alt')
                ->color(Color::hex('#4285F4'));
        }

        if (self::enabled('facebook')) {
            $providers[] = Provider::make('facebook')
                ->label('Facebook')
                ->icon('heroicon-o-users')
                ->color(Color::hex('#1877F2'));
        }

        if (self::enabled('apple')) {
            $providers[] = Provider::make('apple')
                ->label('Apple')
                ->icon('heroicon-o-device-phone-mobile')
                ->color(Color::Gray)
                ->stateless(true);
        }

        return $providers;
    }

    private static function enabled(string $provider): bool
    {
        try {
            $settings = app(GeneralSettings::class);

            $enabled = match ($provider) {
                'google' => (bool) $settings->enable_google_login,
                'facebook' => (bool) $settings->enable_facebook_login,
                'apple' => (bool) $settings->enable_apple_login,
                default => false,
            };

            return $enabled
                && filled(config("services.{$provider}.client_id"))
                && filled(config("services.{$provider}.client_secret"));
        } catch (Throwable) {
            return (bool) config("services.{$provider}.enabled", false)
                && filled(config("services.{$provider}.client_id"))
                && filled(config("services.{$provider}.client_secret"));
        }
    }
}
