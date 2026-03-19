<?php

namespace Modules\Site\App\Support;

use Illuminate\Support\Facades\Storage;

final class LocalMedia
{
    public const DISK = 'public';

    public static function disk(): string
    {
        return self::DISK;
    }

    public static function managesPath(mixed $path): bool
    {
        $value = is_string($path) ? trim($path) : '';

        return $value !== ''
            && ! self::isExternalUrl($value)
            && ! self::isAssetPath($value);
    }

    public static function url(mixed $path): ?string
    {
        $value = is_string($path) ? trim($path) : '';

        if ($value === '') {
            return null;
        }

        if (self::isExternalUrl($value)) {
            return $value;
        }

        if (self::isAssetPath($value)) {
            return asset($value);
        }

        return Storage::disk(self::DISK)->url($value);
    }

    private static function isAssetPath(string $path): bool
    {
        return str_starts_with($path, 'images/');
    }

    private static function isExternalUrl(string $path): bool
    {
        return str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, '//');
    }
}
