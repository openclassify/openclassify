<?php

namespace Modules\Location\Support;

use Illuminate\Support\Collection;
use Tapp\FilamentCountryCodeField\Enums\CountriesEnum;

class CountryCodeManager
{
    public static function defaultCountryCode(): string
    {
        return self::normalizeCountryCode(config('app.default_country_code', '+90'));
    }

    public static function defaultCountryIso2(): string
    {
        return self::iso2FromCountryCode(self::defaultCountryCode()) ?? 'TR';
    }

    public static function normalizeCountryCode(?string $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '+90';
        }

        if (self::isValidCountryCode($value)) {
            return $value;
        }

        return self::countryCodeFromIso2($value) ?? '+90';
    }

    public static function isValidCountryCode(?string $value): bool
    {
        if (! filled($value)) {
            return false;
        }

        return self::countries()->contains(fn (array $country): bool => $country['country_code'] === trim((string) $value));
    }

    public static function countryCodeFromIso2(?string $iso2): ?string
    {
        $iso2 = strtoupper(trim((string) $iso2));

        if ($iso2 === '') {
            return null;
        }

        return self::countries()
            ->first(fn (array $country): bool => $country['iso2'] === $iso2)['country_code'] ?? null;
    }

    public static function iso2FromCountryCode(?string $countryCode): ?string
    {
        $countryCode = trim((string) $countryCode);

        if ($countryCode === '') {
            return null;
        }

        return self::countries()
            ->first(fn (array $country): bool => $country['country_code'] === $countryCode)['iso2'] ?? null;
    }

    public static function labelFromCountryCode(?string $countryCode): ?string
    {
        $countryCode = trim((string) $countryCode);

        if ($countryCode === '') {
            return null;
        }

        return self::countries()
            ->first(fn (array $country): bool => $country['country_code'] === $countryCode)['english_label'] ?? null;
    }

    public static function countryCodeFromLabelOrCode(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        if (self::isValidCountryCode($value)) {
            return $value;
        }

        $fromIso = self::countryCodeFromIso2($value);

        if ($fromIso) {
            return $fromIso;
        }

        $normalizedInput = self::normalizeLabel($value);

        return self::countries()
            ->first(function (array $country) use ($normalizedInput): bool {
                $normalizedLabel = self::normalizeLabel($country['label']);
                $normalizedEnglish = self::normalizeLabel($country['english_label']);

                return $normalizedInput === $normalizedLabel
                    || $normalizedInput === $normalizedEnglish
                    || str_contains($normalizedLabel, $normalizedInput)
                    || str_contains($normalizedEnglish, $normalizedInput)
                    || str_contains($normalizedInput, $normalizedLabel)
                    || str_contains($normalizedInput, $normalizedEnglish);
            })['country_code'] ?? null;
    }

    public static function normalizeStoredCountry(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        $countryCode = self::countryCodeFromLabelOrCode($value);

        if (! $countryCode) {
            return $value;
        }

        return self::labelFromCountryCode($countryCode) ?? $value;
    }

    private static function countries(): Collection
    {
        static $countries;

        if ($countries instanceof Collection) {
            return $countries;
        }

        $countries = collect(CountriesEnum::cases())
            ->map(function (CountriesEnum $country): array {
                $countryKey = $country->value;
                $iso2 = strtoupper(explode('_', $countryKey)[0] ?? $countryKey);
                $label = (string) trans("filament-country-code-field::countries.{$countryKey}");
                $englishLabel = (string) trans("filament-country-code-field::countries.{$countryKey}", [], 'en');

                return [
                    'country_code' => $country->getCountryCode(),
                    'iso2' => $iso2,
                    'label' => $label,
                    'english_label' => $englishLabel,
                ];
            })
            ->values();

        return $countries;
    }

    private static function normalizeLabel(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = preg_replace('/[^a-z0-9]+/u', ' ', $value) ?? $value;

        return trim(preg_replace('/\s+/', ' ', $value) ?? $value);
    }
}
