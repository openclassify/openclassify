<?php

namespace Modules\Listing\Support;

use Illuminate\Support\Collection;
use Modules\Category\Models\Category;

final class SampleListingImageCatalog
{
    private const DIRECTORY = 'sample_image';
    private const MAX_PIXELS = 12000000;
    private const MAX_EDGE = 4200;

    private const CATEGORY_IMAGES = [
        'electronics-phones' => [
            'phone.jpeg',
        ],
        'electronics-computers' => [
            'laptop.jpg',
            'macbook.jpg',
            'tech product macbook digital image render macbook pro.jpg',
        ],
        'electronics-tablets' => [
            'tech product macbook digital image render macbook pro.jpg',
            'phone.jpeg',
        ],
        'electronics-tvs' => [
            'headphones.jpg',
            'macbook.jpg',
        ],
        'vehicles-cars' => [
            'car.jpeg',
            'car2.jpeg',
            'sportscars car sports car vehicle.jpg',
        ],
        'vehicles-motorcycles' => [
            'sport motorbike product photography products moto sports bike enduro motorsports clothing.jpg',
        ],
        'vehicles-trucks' => [
            'car2.jpeg',
            'car.jpeg',
        ],
        'vehicles-boats' => [
            'sportscars car sports car vehicle.jpg',
            'car.jpeg',
        ],
        'real-estate-for-sale' => [
            'roof large house fence gate.jpg',
            'house interior design home interior bedroom.jpg',
        ],
        'real-estate-for-rent' => [
            'house interior design home interior bedroom.jpg',
            'roof large house fence gate.jpg',
        ],
        'real-estate-commercial' => [
            'office building black laptop programming grey interior desk men .jpg',
            'roof large house fence gate.jpg',
        ],
        'fashion-men' => [
            'grey product photography hat sustainable fashion beanie ethical fashion ambleside .jpg',
            'sunglasses.jpg',
        ],
        'fashion-women' => [
            'fashion natural wedding product shoes.jpg',
            'sunglasses.jpg',
        ],
        'fashion-kids' => [
            'nike-sport-wear.png',
            'fashion natural wedding product shoes.jpg',
        ],
        'fashion-shoes' => [
            'fashion natural wedding product shoes.jpg',
            'nike-sport-wear.png',
        ],
        'home-garden-furniture' => [
            'house interior design home interior bedroom.jpg',
            'cup.jpg',
        ],
        'home-garden-garden' => [
            'roof large house fence gate.jpg',
            'house interior design home interior bedroom.jpg',
        ],
        'home-garden-appliances' => [
            'cup.jpg',
            'house interior design home interior bedroom.jpg',
        ],
        'sports-outdoor' => [
            'sport motorbike product photography products moto sports bike enduro motorsports clothing.jpg',
            'nike-sport-wear.png',
        ],
        'sports-fitness' => [
            'smart-watch.jpg',
            ' watch_band.jpg',
            'nike-sport-wear.png',
        ],
        'sports-team-sports' => [
            'nike-sport-wear.png',
            'smart-watch.jpg',
        ],
        'jobs-full-time' => [
            'business white career hiring recruitment academic jobs.jpg',
            'office business people laptop work team classroom grey teamwork table.jpg',
        ],
        'jobs-part-time' => [
            'jobs.jpg',
            'business white career hiring recruitment academic jobs.jpg',
        ],
        'jobs-freelance' => [
            'office business technology meeting coding grey engineering engineer software engineer professional woman whiteboard tutor.jpg',
            'office building black laptop programming grey interior desk men .jpg',
        ],
        'services-cleaning' => [
            'office business work team white customer service studio office building.jpg',
            'cup.jpg',
        ],
        'services-repair' => [
            'office building black laptop programming grey interior desk men .jpg',
            'office business technology meeting coding grey engineering engineer software engineer professional woman whiteboard tutor.jpg',
        ],
        'services-education' => [
            'office business people laptop work team classroom grey teamwork table.jpg',
            'business white career hiring recruitment academic jobs.jpg',
        ],
    ];

    private const FAMILY_IMAGES = [
        'electronics' => [
            'phone.jpeg',
            'laptop.jpg',
            'macbook.jpg',
            'tech product macbook digital image render macbook pro.jpg',
            'headphones.jpg',
            'smart-watch.jpg',
            ' watch_band.jpg',
        ],
        'vehicles' => [
            'car.jpeg',
            'car2.jpeg',
            'sportscars car sports car vehicle.jpg',
            'sport motorbike product photography products moto sports bike enduro motorsports clothing.jpg',
        ],
        'real-estate' => [
            'roof large house fence gate.jpg',
            'house interior design home interior bedroom.jpg',
            'office building black laptop programming grey interior desk men .jpg',
        ],
        'fashion' => [
            'fashion natural wedding product shoes.jpg',
            'grey product photography hat sustainable fashion beanie ethical fashion ambleside .jpg',
            'nike-sport-wear.png',
            'sunglasses.jpg',
        ],
        'home-garden' => [
            'house interior design home interior bedroom.jpg',
            'roof large house fence gate.jpg',
            'cup.jpg',
        ],
        'sports' => [
            'sport motorbike product photography products moto sports bike enduro motorsports clothing.jpg',
            'nike-sport-wear.png',
            'smart-watch.jpg',
            ' watch_band.jpg',
        ],
        'jobs' => [
            'jobs.jpg',
            'business white career hiring recruitment academic jobs.jpg',
            'office business people laptop work team classroom grey teamwork table.jpg',
            'office business technology meeting coding grey engineering engineer software engineer professional woman whiteboard tutor.jpg',
            'vintage red text retro machine sign blur bokeh flag hiring.jpg',
        ],
        'services' => [
            'office business work team white customer service studio office building.jpg',
            'office building black laptop programming grey interior desk men .jpg',
            'office business people laptop work team classroom grey teamwork table.jpg',
            'cup.jpg',
        ],
    ];

    public static function uniquePaths(): Collection
    {
        return self::allPaths()
            ->sortBy(fn (string $path): string => strtolower((string) basename($path)))
            ->map(fn (string $path): array => [
                'path' => $path,
                'hash' => md5_file($path) ?: strtolower((string) basename($path)),
            ])
            ->unique('hash')
            ->pluck('path')
            ->values();
    }

    public static function pathFor(Category $category, int $seed): ?string
    {
        $paths = self::uniquePaths();

        if ($paths->isEmpty()) {
            return null;
        }

        if ($seed < 0 || $seed >= $paths->count()) {
            return null;
        }

        return $paths->get($seed);
    }

    public static function fileNameFor(string $absolutePath, string $slug): string
    {
        $extension = strtolower((string) pathinfo($absolutePath, PATHINFO_EXTENSION));
        $hash = md5_file($absolutePath);
        $hashSuffix = is_string($hash) && $hash !== ''
            ? '-'.substr($hash, 0, 8)
            : '';

        return $slug.$hashSuffix.($extension !== '' ? '.'.$extension : '');
    }

    private static function resolvePathsForSlug(string $slug): Collection
    {
        $fileNames = self::CATEGORY_IMAGES[$slug] ?? self::FAMILY_IMAGES[$slug] ?? [];

        return collect($fileNames)
            ->map(fn (string $fileName): string => public_path(self::DIRECTORY.'/'.$fileName))
            ->filter(fn (string $path): bool => self::isAllowed($path))
            ->values();
    }

    private static function allPaths(): Collection
    {
        $paths = glob(public_path(self::DIRECTORY.'/*')) ?: [];

        return collect($paths)
            ->filter(function (string $path): bool {
                if (! self::isAllowed($path)) {
                    return false;
                }

                $extension = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));

                return in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true);
            })
            ->values();
    }

    private static function isAllowed(string $path): bool
    {
        if (! is_file($path)) {
            return false;
        }

        if (filesize($path) > (int) config('media-library.max_file_size', 10 * 1024 * 1024)) {
            return false;
        }

        $dimensions = @getimagesize($path);

        if (! is_array($dimensions)) {
            return false;
        }

        $width = (int) ($dimensions[0] ?? 0);
        $height = (int) ($dimensions[1] ?? 0);

        if ($width < 1 || $height < 1) {
            return false;
        }

        if (max($width, $height) > self::MAX_EDGE) {
            return false;
        }

        return ($width * $height) <= self::MAX_PIXELS;
    }
}
