<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist
    |--------------------------------------------------------------------------
    |
    | If maintenance mode for the application (not Framework) is enabled,
    | then the system will behave similar to "php artisan down" but for
    | the application ONLY. Any other sites on the system configured
    | otherwise will still behave as intended.
    |
    */

    'enabled' => env('MAINTENANCE_MODE', false),

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist
    |--------------------------------------------------------------------------
    |
    | If maintenance mode is enabled, only these IPs will be allowed to
    | view public facing content.
    |
    */

    'ip_whitelist' => explode(',', env('IP_WHITELIST')),

    /*
    |--------------------------------------------------------------------------
    | Maintenance Authentication
    |--------------------------------------------------------------------------
    |
    | If maintenance mode is enabled, prompt for basic authentication?
    | The user must have the "streams::maintenance.access" permission
    | in order to view public facing content.
    |
    */

    'auth' => env('MAINTENANCE_AUTH', false)

];
