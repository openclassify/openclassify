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

    /**
     * @return array<int, array{code: string, name: string, phone_code: string}>
     */
    private function countries(): array
    {
        $countries = [];

        foreach (CountriesEnum::cases() as $countryEnum) {
            $value = $countryEnum->value;
            $phoneCode = $this->normalizePhoneCode($countryEnum->getCountryCode());

            if ($value === 'us_ca') {
                $countries['US'] = [
                    'code' => 'US',
                    'name' => 'Amerika Birleşik Devletleri',
                    'phone_code' => $phoneCode,
                ];
                $countries['CA'] = [
                    'code' => 'CA',
                    'name' => 'Kanada',
                    'phone_code' => $phoneCode,
                ];

                continue;
            }

            if ($value === 'ru_kz') {
                $countries['RU'] = [
                    'code' => 'RU',
                    'name' => 'Rusya',
                    'phone_code' => $phoneCode,
                ];
                $countries['KZ'] = [
                    'code' => 'KZ',
                    'name' => 'Kazakistan',
                    'phone_code' => $phoneCode,
                ];

                continue;
            }

            $key = 'filament-country-code-field::countries.' . $value;
            $labelTr = trim((string) trans($key, [], 'tr'));
            $labelEn = trim((string) trans($key, [], 'en'));

            $name = $labelTr !== '' && $labelTr !== $key
                ? $labelTr
                : ($labelEn !== '' && $labelEn !== $key ? $labelEn : strtoupper($value));

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

    /**
     * @return array<int, string>
     */
    private function turkeyCities(): array
    {
        return [
            'Adana',
            'Adıyaman',
            'Afyonkarahisar',
            'Ağrı',
            'Aksaray',
            'Amasya',
            'Ankara',
            'Antalya',
            'Ardahan',
            'Artvin',
            'Aydın',
            'Balıkesir',
            'Bartın',
            'Batman',
            'Bayburt',
            'Bilecik',
            'Bingöl',
            'Bitlis',
            'Bolu',
            'Burdur',
            'Bursa',
            'Çanakkale',
            'Çankırı',
            'Çorum',
            'Denizli',
            'Diyarbakır',
            'Düzce',
            'Edirne',
            'Elazığ',
            'Erzincan',
            'Erzurum',
            'Eskişehir',
            'Gaziantep',
            'Giresun',
            'Gümüşhane',
            'Hakkari',
            'Hatay',
            'Iğdır',
            'Isparta',
            'İstanbul',
            'İzmir',
            'Kahramanmaraş',
            'Karabük',
            'Karaman',
            'Kars',
            'Kastamonu',
            'Kayseri',
            'Kilis',
            'Kırıkkale',
            'Kırklareli',
            'Kırşehir',
            'Kocaeli',
            'Konya',
            'Kütahya',
            'Malatya',
            'Manisa',
            'Mardin',
            'Mersin',
            'Muğla',
            'Muş',
            'Nevşehir',
            'Niğde',
            'Ordu',
            'Osmaniye',
            'Rize',
            'Sakarya',
            'Samsun',
            'Siirt',
            'Sinop',
            'Sivas',
            'Şanlıurfa',
            'Şırnak',
            'Tekirdağ',
            'Tokat',
            'Trabzon',
            'Tunceli',
            'Uşak',
            'Van',
            'Yalova',
            'Yozgat',
            'Zonguldak',
        ];
    }
}
