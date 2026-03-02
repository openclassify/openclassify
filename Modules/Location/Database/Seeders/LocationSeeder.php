<?php
namespace Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Location\Models\Country;
use Modules\Location\Models\City;
use Modules\Location\Models\District;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Turkey', 'code' => 'TR', 'phone_code' => '+90', 'flag' => '🇹🇷',
             'cities' => ['Istanbul' => ['Beyoglu', 'Kadikoy', 'Besiktas'], 'Ankara' => ['Cankaya', 'Kecioren'], 'Izmir' => ['Konak', 'Karsiyaka']]],
            ['name' => 'United States', 'code' => 'US', 'phone_code' => '+1', 'flag' => '🇺🇸',
             'cities' => ['New York' => ['Manhattan', 'Brooklyn'], 'Los Angeles' => ['Hollywood', 'Venice'], 'Chicago' => ['Downtown', 'Midtown']]],
            ['name' => 'United Kingdom', 'code' => 'GB', 'phone_code' => '+44', 'flag' => '🇬🇧',
             'cities' => ['London' => ['Westminster', 'Shoreditch'], 'Manchester' => ['City Centre'], 'Birmingham' => ['Jewellery Quarter']]],
            ['name' => 'Germany', 'code' => 'DE', 'phone_code' => '+49', 'flag' => '🇩🇪',
             'cities' => ['Berlin' => ['Mitte', 'Prenzlauer Berg'], 'Munich' => ['Schwabing', 'Maxvorstadt']]],
            ['name' => 'France', 'code' => 'FR', 'phone_code' => '+33', 'flag' => '🇫🇷',
             'cities' => ['Paris' => ['Marais', 'Montmartre'], 'Lyon' => ['Presquile']]],
        ];

        foreach ($locations as $countryData) {
            $cities = $countryData['cities'];
            unset($countryData['cities']);
            $country = Country::firstOrCreate(['code' => $countryData['code']], $countryData);
            foreach ($cities as $cityName => $districts) {
                $city = City::firstOrCreate(['name' => $cityName, 'country_id' => $country->id]);
                foreach ($districts as $districtName) {
                    District::firstOrCreate(['name' => $districtName, 'city_id' => $city->id]);
                }
            }
        }
    }
}
