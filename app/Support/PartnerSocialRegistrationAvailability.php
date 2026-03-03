<?php

namespace App\Support;

use App\Settings\GeneralSettings;
use Throwable;

class PartnerSocialRegistrationAvailability
{
    /**
     * @return array<int, string>
     */
    private const PROVIDERS = ['google', 'facebook', 'apple'];

    public static function isAvailable(): bool
    {
        foreach (self::PROVIDERS as $provider) {
            if (self::providerEnabled($provider) && self::providerCredentialsReady($provider)) {
                return true;
            }
        }

        return false;
    }

    private static function providerEnabled(string $provider): bool
    {
        try {
            /** @var GeneralSettings $settings */
            $settings = app(GeneralSettings::class);

            return match ($provider) {
                'google' => (bool) ($settings->enable_google_login ?? false),
                'facebook' => (bool) ($settings->enable_facebook_login ?? false),
                'apple' => (bool) ($settings->enable_apple_login ?? false),
                default => false,
            };
        } catch (Throwable) {
            return (bool) config("services.{$provider}.enabled", false);
        }
    }

    private static function providerCredentialsReady(string $provider): bool
    {
        return filled(config("services.{$provider}.client_id"))
            && filled(config("services.{$provider}.client_secret"));
    }
}
