<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.enable_google_login', false);
        $this->migrator->add('general.google_client_id', null);
        $this->migrator->add('general.google_client_secret', null);

        $this->migrator->add('general.enable_facebook_login', false);
        $this->migrator->add('general.facebook_client_id', null);
        $this->migrator->add('general.facebook_client_secret', null);

        $this->migrator->add('general.enable_apple_login', false);
        $this->migrator->add('general.apple_client_id', null);
        $this->migrator->add('general.apple_client_secret', null);
    }
};
