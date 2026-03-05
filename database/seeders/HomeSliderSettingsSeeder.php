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
        $settings->home_slides = HomeSlideDefaults::normalize($settings->home_slides ?? []);

        $settings->save();
    }

    private function defaultHomeSlides(): array
    {
        return HomeSlideDefaults::defaults();
    }
}
