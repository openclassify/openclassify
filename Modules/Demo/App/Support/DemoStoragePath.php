<?php

declare(strict_types=1);

namespace Modules\Demo\App\Support;

use Illuminate\Support\Facades\Storage;
use Modules\Site\App\Support\LocalMedia;
use Throwable;

final class DemoStoragePath
{
    public static function prefix(string $path): string
    {
        $uuid = trim((string) config('demo.active_uuid', ''));

        if ($uuid === '') {
            return ltrim($path, '/');
        }

        return 'demo/'.$uuid.'/'.ltrim($path, '/');
    }

    public static function purgeForUuid(string $uuid): void
    {
        $uuid = trim($uuid);

        if ($uuid === '') {
            return;
        }

        $prefix = 'demo/'.$uuid;

        try {
            Storage::disk(LocalMedia::disk())->deleteDirectory($prefix);
        } catch (Throwable) {
        }
    }
}
