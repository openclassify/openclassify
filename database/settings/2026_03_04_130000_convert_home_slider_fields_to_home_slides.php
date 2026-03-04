<?php

use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaultSlide = [
            'badge' => 'OpenClassify Marketplace',
            'title' => 'İlan ücreti ödemeden ürününü hızla sat!',
            'subtitle' => 'Buy and sell everything in your area',
            'primary_button_text' => 'İncele',
            'secondary_button_text' => 'Post Listing',
        ];

        if (! $this->migrator->exists('general.home_slides')) {
            $this->migrator->add('general.home_slides', [[
                'badge' => $this->legacySetting('home_slider_badge', $defaultSlide['badge']),
                'title' => $this->legacySetting('home_slider_title', $defaultSlide['title']),
                'subtitle' => $this->legacySetting('home_slider_subtitle', $defaultSlide['subtitle']),
                'primary_button_text' => $this->legacySetting('home_slider_primary_button_text', $defaultSlide['primary_button_text']),
                'secondary_button_text' => $this->legacySetting('home_slider_secondary_button_text', $defaultSlide['secondary_button_text']),
            ]]);
        } else {
            $this->migrator->update('general.home_slides', function ($slides) use ($defaultSlide) {
                return $this->normalizeSlides($slides, $defaultSlide);
            });
        }

        $this->migrator->deleteIfExists('general.home_slider_badge');
        $this->migrator->deleteIfExists('general.home_slider_title');
        $this->migrator->deleteIfExists('general.home_slider_subtitle');
        $this->migrator->deleteIfExists('general.home_slider_primary_button_text');
        $this->migrator->deleteIfExists('general.home_slider_secondary_button_text');
    }

    private function legacySetting(string $name, string $default): string
    {
        $payload = DB::table('settings')
            ->where('group', 'general')
            ->where('name', $name)
            ->value('payload');

        $decoded = $this->decodePayload($payload);

        return is_string($decoded) && trim($decoded) !== ''
            ? trim($decoded)
            : $default;
    }

    private function normalizeSlides(mixed $slides, array $defaultSlide): array
    {
        if (! is_array($slides)) {
            return [$defaultSlide];
        }

        $normalized = collect($slides)
            ->filter(fn ($slide): bool => is_array($slide))
            ->map(function (array $slide) use ($defaultSlide): ?array {
                $badge = trim((string) ($slide['badge'] ?? ''));
                $title = trim((string) ($slide['title'] ?? ''));
                $subtitle = trim((string) ($slide['subtitle'] ?? ''));
                $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
                $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));

                if ($title === '') {
                    return null;
                }

                return [
                    'badge' => $badge !== '' ? $badge : $defaultSlide['badge'],
                    'title' => $title,
                    'subtitle' => $subtitle !== '' ? $subtitle : $defaultSlide['subtitle'],
                    'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : $defaultSlide['primary_button_text'],
                    'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : $defaultSlide['secondary_button_text'],
                ];
            })
            ->filter(fn ($slide): bool => is_array($slide))
            ->values()
            ->all();

        return $normalized !== [] ? $normalized : [$defaultSlide];
    }

    private function decodePayload(mixed $payload): mixed
    {
        if (! is_string($payload)) {
            return $payload;
        }

        $decoded = json_decode($payload, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $payload;
    }
};
