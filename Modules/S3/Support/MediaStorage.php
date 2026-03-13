<?php

namespace Modules\S3\Support;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\Site\App\Settings\GeneralSettings;
use Throwable;

final class MediaStorage
{
    public const DRIVER_LOCAL = 'local';

    public const DRIVER_S3 = 's3';

    public static function options(): array
    {
        return [
            self::DRIVER_S3 => 'S3 Object Storage',
            self::DRIVER_LOCAL => 'Local Storage',
        ];
    }

    public static function defaultDriver(): string
    {
        return self::coerceDriver(config('media_storage.default_driver'))
            ?? self::DRIVER_S3;
    }

    public static function activeDriver(): string
    {
        if (! self::hasSettingsTable()) {
            return self::defaultDriver();
        }

        try {
            return self::normalizeDriver(app(GeneralSettings::class)->media_disk ?? null);
        } catch (Throwable) {
            return self::defaultDriver();
        }
    }

    public static function normalizeDriver(mixed $driver): string
    {
        return self::coerceDriver($driver) ?? self::defaultDriver();
    }

    public static function diskFromDriver(mixed $driver = null): string
    {
        return self::normalizeDriver($driver) === self::DRIVER_LOCAL
            ? (string) config('media_storage.local_disk', 'public')
            : (string) config('media_storage.cloud_disk', 's3');
    }

    public static function activeDisk(): string
    {
        return self::diskFromDriver(self::activeDriver());
    }

    public static function storedDisk(mixed $disk = null, mixed $driver = null): string
    {
        if (is_string($disk) && trim($disk) !== '') {
            return self::diskFromDriver(trim($disk) === 'public' ? self::DRIVER_LOCAL : trim($disk));
        }

        return self::diskFromDriver($driver);
    }

    public static function managesPath(mixed $path): bool
    {
        $path = is_string($path) ? trim($path) : '';

        if ($path === '') {
            return false;
        }

        return ! self::isExternalUrl($path) && ! self::isAssetPath($path);
    }

    public static function url(mixed $path, mixed $disk = null): ?string
    {
        $path = is_string($path) ? trim($path) : '';

        if ($path === '') {
            return null;
        }

        if (self::isExternalUrl($path)) {
            return $path;
        }

        if (self::isAssetPath($path)) {
            return asset($path);
        }

        return Storage::disk(self::storedDisk($disk))->url($path);
    }

    public static function applyRuntimeConfig(): void
    {
        $disk = self::activeDisk();

        config([
            'filesystems.default' => $disk,
            'filemanager.disk' => $disk,
            'filament.default_filesystem_disk' => $disk,
            'media-library.disk_name' => $disk,
            'video.disk' => $disk,
        ]);
    }

    private static function coerceDriver(mixed $driver): ?string
    {
        if (! is_string($driver)) {
            return null;
        }

        return match (strtolower(trim($driver))) {
            self::DRIVER_LOCAL, 'public' => self::DRIVER_LOCAL,
            self::DRIVER_S3 => self::DRIVER_S3,
            default => null,
        };
    }

    private static function hasSettingsTable(): bool
    {
        try {
            return Schema::hasTable('settings');
        } catch (Throwable) {
            return false;
        }
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
