<?php

declare(strict_types=1);

use Modules\Site\App\Support\LocalMedia;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('general.media_disk')) {
            $this->migrator->add('general.media_disk', LocalMedia::disk());
        }

        if (! $this->migrator->exists('general.site_logo_disk')) {
            $this->migrator->add('general.site_logo_disk', null);
        }
    }
};
