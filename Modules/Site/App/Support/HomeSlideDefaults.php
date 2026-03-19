<?php

namespace Modules\Site\App\Support;

use Illuminate\Support\Arr;

final class HomeSlideDefaults
{
    public static function defaults(): array
    {
        return [
            [
                'badge' => 'Featured Marketplace',
                'title' => 'List products in minutes and reach local buyers faster.',
                'subtitle' => 'A calm, simple marketplace for everyday electronics, home finds, and local deals.',
                'primary_button_text' => 'Browse Listings',
                'secondary_button_text' => 'Post Listing',
                'image_path' => 'images/home-slides/slide-marketplace.svg',
            ],
            [
                'badge' => 'Fresh Categories',
                'title' => 'Explore electronics, vehicles, fashion, and home in one clean flow.',
                'subtitle' => 'Move between categories quickly, compare listings, and message sellers without friction.',
                'primary_button_text' => 'See Categories',
                'secondary_button_text' => 'Start Now',
                'image_path' => 'images/home-slides/slide-categories.svg',
            ],
            [
                'badge' => 'Local Shopping',
                'title' => 'Discover nearby second-hand picks with a more polished storefront.',
                'subtitle' => 'Filter by city, save favorites, and turn local demand into quick conversations.',
                'primary_button_text' => 'Nearby Deals',
                'secondary_button_text' => 'Sell for Free',
                'image_path' => 'images/home-slides/slide-local.svg',
            ],
        ];
    }

    public static function normalize(mixed $slides): array
    {
        $defaults = self::defaults();
        $source = is_array($slides) ? $slides : [];

        $normalized = collect($source)
            ->filter(fn ($slide): bool => is_array($slide))
            ->values()
            ->map(function (array $slide, int $index) use ($defaults): ?array {
                $fallback = $defaults[$index] ?? $defaults[array_key_last($defaults)];
                $badge = trim((string) ($slide['badge'] ?? ''));
                $title = trim((string) ($slide['title'] ?? ''));
                $subtitle = trim((string) ($slide['subtitle'] ?? ''));
                $primaryButtonText = trim((string) ($slide['primary_button_text'] ?? ''));
                $secondaryButtonText = trim((string) ($slide['secondary_button_text'] ?? ''));
                $imagePath = self::normalizeImagePath($slide['image_path'] ?? null);

                if ($title === '') {
                    return null;
                }

                return [
                    'badge' => $badge !== '' ? $badge : $fallback['badge'],
                    'title' => $title,
                    'subtitle' => $subtitle !== '' ? $subtitle : $fallback['subtitle'],
                    'primary_button_text' => $primaryButtonText !== '' ? $primaryButtonText : $fallback['primary_button_text'],
                    'secondary_button_text' => $secondaryButtonText !== '' ? $secondaryButtonText : $fallback['secondary_button_text'],
                    'image_path' => $imagePath !== '' ? $imagePath : ($fallback['image_path'] ?? null),
                ];
            })
            ->filter(fn ($slide): bool => is_array($slide))
            ->values();

        return $normalized
            ->concat(collect($defaults)->slice($normalized->count()))
            ->take(count($defaults))
            ->values()
            ->all();
    }

    private static function normalizeImagePath(mixed $value): string
    {
        if (is_string($value)) {
            return trim($value);
        }

        if (is_array($value)) {
            $firstValue = Arr::first($value, fn ($item): bool => is_string($item) && trim($item) !== '');

            return is_string($firstValue) ? trim($firstValue) : '';
        }

        return '';
    }
}
