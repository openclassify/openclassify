<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.enable_google_maps', false);
        $this->migrator->add('general.google_maps_api_key', null);
    }
};
