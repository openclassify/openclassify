<?php

namespace Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;
use Tapp\FilamentCountryCodeField\Enums\CountriesEnum;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->countries() as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                [
                    'name' => $country['name'],
                    'phone_code' => $country['phone_code'],
                    'is_active' => true,
                ]
            );
        }

        $turkey = Country::query()->where('code', 'TR')->first();

        if (! $turkey) {
            return;
        }

        $turkeyCities = $this->turkeyCities();

        foreach ($turkeyCities as $city) {
            City::updateOrCreate(
                ['country_id' => (int) $turkey->id, 'name' => $city],
                ['is_active' => true]
            );
        }

        City::query()
            ->where('country_id', (int) $turkey->id)
            ->whereNotIn('name', $turkeyCities)
            ->delete();
    }

    private function countries(): array
    {
        $countries = [];

        foreach (CountriesEnum::cases() as $countryEnum) {
            $value = $countryEnum->value;
            $phoneCode = $this->normalizePhoneCode($countryEnum->getCountryCode());

            if ($value === 'us_ca') {
                $countries['US'] = [
                    'code' => 'US',
                    'name' => 'United States',
                    'phone_code' => $phoneCode,
                ];
                $countries['CA'] = [
                    'code' => 'CA',
                    'name' => 'Canada',
                    'phone_code' => $phoneCode,
                ];

                continue;
            }

            if ($value === 'ru_kz') {
                $countries['RU'] = [
                    'code' => 'RU',
                    'name' => 'Russia',
                    'phone_code' => $phoneCode,
                ];
                $countries['KZ'] = [
                    'code' => 'KZ',
                    'name' => 'Kazakhstan',
                    'phone_code' => $phoneCode,
                ];

                continue;
            }

            $key = 'filament-country-code-field::countries.'.$value;
            $labelEn = trim((string) trans($key, [], 'en'));

            $name = $labelEn !== '' && $labelEn !== $key ? $labelEn : strtoupper($value);

            $iso2 = strtoupper(explode('_', $value)[0] ?? $value);

            $countries[$iso2] = [
                'code' => $iso2,
                'name' => $name,
                'phone_code' => $phoneCode,
            ];
        }

        return collect($countries)
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->values()
            ->all();
    }

    private function normalizePhoneCode(string $phoneCode): string
    {
        $normalized = trim(explode(',', $phoneCode)[0]);
        $normalized = str_replace(' ', '', $normalized);

        return substr($normalized, 0, 10);
    }

    private function turkeyCities(): array
    {
        return [
            'Adana',
            'Adiyaman',
            'Afyonkarahisar',
            'Agri',
            'Aksaray',
            'Amasya',
            'Ankara',
            'Antalya',
            'Ardahan',
            'Artvin',
            'Aydin',
            'Balikesir',
            'Bartin',
            'Batman',
            'Bayburt',
            'Bilecik',
            'Bingol',
            'Bitlis',
            'Bolu',
            'Burdur',
            'Bursa',
            'Canakkale',
            'Cankiri',
            'Corum',
            'Denizli',
            'Diyarbakir',
            'Duzce',
            'Edirne',
            'Elazig',
            'Erzincan',
            'Erzurum',
            'Eskisehir',
            'Gaziantep',
            'Giresun',
            'Gumushane',
            'Hakkari',
            'Hatay',
            'Igdir',
            'Isparta',
            'Istanbul',
            'Izmir',
            'Kahramanmaras',
            'Karabuk',
            'Karaman',
            'Kars',
            'Kastamonu',
            'Kayseri',
            'Kilis',
            'Kirikkale',
            'Kirklareli',
            'Kirsehir',
            'Kocaeli',
            'Konya',
            'Kutahya',
            'Malatya',
            'Manisa',
            'Mardin',
            'Mersin',
            'Mugla',
            'Mus',
            'Nevsehir',
            'Nigde',
            'Ordu',
            'Osmaniye',
            'Rize',
            'Sakarya',
            'Samsun',
            'Siirt',
            'Sinop',
            'Sivas',
            'Sanliurfa',
            'Sirnak',
            'Tekirdag',
            'Tokat',
            'Trabzon',
            'Tunceli',
            'Usak',
            'Van',
            'Yalova',
            'Yozgat',
            'Zonguldak',
        ];
    }
}
