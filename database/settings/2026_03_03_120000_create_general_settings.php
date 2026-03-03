<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'OpenClassify');
        $this->migrator->add('general.site_description', 'The marketplace for buying and selling everything.');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.default_language', 'en');
        $this->migrator->add('general.currencies', ['USD']);
        $this->migrator->add('general.sender_email', 'hello@example.com');
        $this->migrator->add('general.sender_name', 'OpenClassify');
        $this->migrator->add('general.linkedin_url', null);
        $this->migrator->add('general.instagram_url', null);
        $this->migrator->add('general.whatsapp', null);
    }
};
