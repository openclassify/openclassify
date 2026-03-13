<?php

namespace Modules\Listing\Support;

use Modules\Site\App\Settings\GeneralSettings;
use Throwable;

class ListingPanelHelper
{
    public static function currencyCodes(): array
    {
        $codes = collect(config('app.currencies', ['USD']))
            ->filter(fn ($code) => is_string($code) && trim($code) !== '')
            ->map(fn (string $code) => strtoupper(substr(trim($code), 0, 3)))
            ->filter(fn (string $code) => strlen($code) === 3)
            ->unique()
            ->values()
            ->all();

        return $codes !== [] ? $codes : ['USD'];
    }

    public static function currencyOptions(): array
    {
        return collect(self::currencyCodes())
            ->mapWithKeys(fn (string $code) => [$code => $code])
            ->all();
    }

    public static function defaultCurrency(): string
    {
        return self::currencyCodes()[0] ?? 'USD';
    }

    public static function normalizeCurrency(?string $currency): string
    {
        $normalized = strtoupper(substr(trim((string) $currency), 0, 3));
        $codes = self::currencyCodes();

        if (in_array($normalized, $codes, true)) {
            return $normalized;
        }

        return self::defaultCurrency();
    }

    public static function googleMapsEnabled(): bool
    {
        try {
            return (bool) app(GeneralSettings::class)->enable_google_maps;
        } catch (Throwable) {
            return false;
        }
    }
}
