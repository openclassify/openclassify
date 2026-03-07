<?php

use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('general.media_disk')) {
            $this->migrator->add('general.media_disk', 's3');
        } else {
            $this->migrator->update('general.media_disk', fn ($value) => in_array($value, ['local', 's3'], true) ? $value : 's3');
        }

        if (! $this->migrator->exists('general.site_logo_disk')) {
            $this->migrator->add('general.site_logo_disk', $this->legacyDiskForPath($this->settingValue('site_logo')));
        } else {
            $this->migrator->update('general.site_logo_disk', fn ($value) => is_string($value) && trim($value) !== '' ? trim($value) : $this->legacyDiskForPath($this->settingValue('site_logo')));
        }

        if (! $this->migrator->exists('general.home_slides')) {
            return;
        }

        $this->migrator->update('general.home_slides', function ($slides) {
            if (! is_array($slides)) {
                return $slides;
            }

            return collect($slides)
                ->map(function ($slide) {
                    if (! is_array($slide)) {
                        return $slide;
                    }

                    $imagePath = is_string($slide['image_path'] ?? null) ? trim($slide['image_path']) : '';
                    $slide['disk'] = is_string($slide['disk'] ?? null) && trim($slide['disk']) !== ''
                        ? trim($slide['disk'])
                        : $this->legacyDiskForPath($imagePath);

                    return $slide;
                })
                ->all();
        });
    }

    private function legacyDiskForPath(mixed $path): ?string
    {
        if (! is_string($path) || trim($path) === '') {
            return null;
        }

        $path = trim($path);

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, '//')
            || str_starts_with($path, 'images/')
        ) {
            return null;
        }

        return 'public';
    }

    private function settingValue(string $name): mixed
    {
        $payload = DB::table('settings')
            ->where('group', 'general')
            ->where('name', $name)
            ->value('payload');

        if (! is_string($payload)) {
            return $payload;
        }

        $decoded = json_decode($payload, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $payload;
    }
};
