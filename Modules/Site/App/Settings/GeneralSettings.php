<?php

namespace Modules\Site\App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public string $site_description;

    public ?string $site_logo;

    public string $default_language;

    public string $default_country_code;

    public array $currencies;

    public string $sender_email;

    public string $sender_name;

    public ?string $linkedin_url;

    public ?string $instagram_url;

    public ?string $whatsapp;

    public bool $enable_google_maps;

    public ?string $google_maps_api_key;

    public bool $enable_google_login;

    public ?string $google_client_id;

    public ?string $google_client_secret;

    public bool $enable_facebook_login;

    public ?string $facebook_client_id;

    public ?string $facebook_client_secret;

    public bool $enable_apple_login;

    public ?string $apple_client_id;

    public ?string $apple_client_secret;

    public array $home_slides;

    public static function group(): string
    {
        return 'general';
    }
}
