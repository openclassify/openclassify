<?php

namespace Database\Seeders;

use App\Support\HomeSlideDefaults;
use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;

class HomeSliderSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);
        $settings->home_slides = HomeSlideDefaults::defaults();

        $settings->save();
    }
}
