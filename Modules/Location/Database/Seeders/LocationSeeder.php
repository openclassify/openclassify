<?php
namespace Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Location\Models\City;
use Modules\Location\Models\Country;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Turkey', 'code' => 'TR', 'phone_code' => '+90'],
            ['name' => 'United States', 'code' => 'US', 'phone_code' => '+1'],
            ['name' => 'Germany', 'code' => 'DE', 'phone_code' => '+49'],
            ['name' => 'France', 'code' => 'FR', 'phone_code' => '+33'],
            ['name' => 'United Kingdom', 'code' => 'GB', 'phone_code' => '+44'],
            ['name' => 'Spain', 'code' => 'ES', 'phone_code' => '+34'],
            ['name' => 'Italy', 'code' => 'IT', 'phone_code' => '+39'],
            ['name' => 'Russia', 'code' => 'RU', 'phone_code' => '+7'],
            ['name' => 'China', 'code' => 'CN', 'phone_code' => '+86'],
            ['name' => 'Japan', 'code' => 'JP', 'phone_code' => '+81'],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(['code' => $country['code']], array_merge($country, ['is_active' => true]));
        }

        $tr = Country::where('code', 'TR')->first();
        if ($tr) {
            $cities = ['Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Antalya'];
            foreach ($cities as $city) {
                City::firstOrCreate(['name' => $city, 'country_id' => $tr->id]);
            }
        }

        $us = Country::where('code', 'US')->first();
        if ($us) {
            $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix'];
            foreach ($cities as $city) {
                City::firstOrCreate(['name' => $city, 'country_id' => $us->id]);
            }
        }
    }
}
