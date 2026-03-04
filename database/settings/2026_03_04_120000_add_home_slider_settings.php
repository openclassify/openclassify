<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.home_slider_badge', 'OpenClassify Marketplace');
        $this->migrator->add('general.home_slider_title', 'İlan ücreti ödemeden ürününü hızla sat!');
        $this->migrator->add('general.home_slider_subtitle', 'Buy and sell everything in your area');
        $this->migrator->add('general.home_slider_primary_button_text', 'İncele');
        $this->migrator->add('general.home_slider_secondary_button_text', 'Post Listing');
    }
};
