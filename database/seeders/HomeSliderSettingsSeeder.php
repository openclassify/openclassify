<?php

namespace Database\Seeders;

use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;

class HomeSliderSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);
        $fallbackSlide = $this->defaultHomeSlides()[0];

        $slides = is_array($settings->home_slides ?? null) ? $settings->home_slides : [];

        $normalized = collect($slides)
            ->filter(fn ($slide): bool => is_array($slide))
            ->map(function (array $slide) use ($fallbackSlide): ?array {
                $title = trim((string) ($slide['title'] ?? ''));

                if ($title === '') {
                    return null;
                }

                $badge = trim((string) ($slide['badge'] ?? ''));
                $subtitle = trim((string) ($slide['subtitle'] ?? ''));
                $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
                $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));

                return [
                    'badge' => $badge !== '' ? $badge : $fallbackSlide['badge'],
                    'title' => $title,
                    'subtitle' => $subtitle !== '' ? $subtitle : $fallbackSlide['subtitle'],
                    'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : $fallbackSlide['primary_button_text'],
                    'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : $fallbackSlide['secondary_button_text'],
                ];
            })
            ->filter(fn ($slide): bool => is_array($slide))
            ->values()
            ->all();

        $settings->home_slides = $normalized !== [] ? $normalized : $this->defaultHomeSlides();

        $settings->save();
    }

    private function defaultHomeSlides(): array
    {
        return [
            [
                'badge' => 'OpenClassify Marketplace',
                'title' => 'İlan ücreti ödemeden ürününü hızla sat!',
                'subtitle' => 'Buy and sell everything in your area',
                'primary_button_text' => 'İncele',
                'secondary_button_text' => 'Post Listing',
            ],
        ];
    }
}
