<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HomeSliderSettingsSeeder::class,
            \Modules\Location\Database\Seeders\LocationSeeder::class,
            \Modules\Category\Database\Seeders\CategorySeeder::class,
            \Modules\Listing\Database\Seeders\ListingCustomFieldSeeder::class,
        ]);

        if ((bool) config('demo.enabled') || (bool) config('demo.provisioning')) {
            $this->call([
                \Modules\Demo\Database\Seeders\DemoContentSeeder::class,
            ]);
        }
    }
}
