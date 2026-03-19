<?php

use Modules\Site\App\Support\HomeSlideDefaults;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'OpenClassify');
        $this->migrator->add('general.site_description', 'The marketplace for buying and selling everything.');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.default_language', 'en');
        $this->migrator->add('general.default_country_code', '+90');
        $this->migrator->add('general.currencies', ['USD']);
        $this->migrator->add('general.sender_email', 'hello@example.com');
        $this->migrator->add('general.sender_name', 'OpenClassify');
        $this->migrator->add('general.linkedin_url', null);
        $this->migrator->add('general.instagram_url', null);
        $this->migrator->add('general.whatsapp', null);
        $this->migrator->add('general.enable_google_maps', false);
        $this->migrator->add('general.google_maps_api_key', null);
        $this->migrator->add('general.enable_google_login', false);
        $this->migrator->add('general.google_client_id', null);
        $this->migrator->add('general.google_client_secret', null);
        $this->migrator->add('general.enable_facebook_login', false);
        $this->migrator->add('general.facebook_client_id', null);
        $this->migrator->add('general.facebook_client_secret', null);
        $this->migrator->add('general.enable_apple_login', false);
        $this->migrator->add('general.apple_client_id', null);
        $this->migrator->add('general.apple_client_secret', null);
        $this->migrator->add('general.home_slides', HomeSlideDefaults::defaults());
    }
};
