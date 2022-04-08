<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Addon Types
    |--------------------------------------------------------------------------
    |
    | When loading addons the system will look for SLUG-TYPE addons to load.
    |
    */

    'types' => [
        'field_type',
        'extension',
        'module',
        'plugin',
        'theme',
    ],

    /*
    |--------------------------------------------------------------------------
    | Configured Addon Paths
    |--------------------------------------------------------------------------
    |
    | These manually defined addon paths can be helpful
    | when you need to push an addon path into load
    | that is shipped IN another addon.
    |
    */

    'paths' => [
        //addons/shared/example-module/addons/anomaly/fancy-field_type'
    ],

    /*
    |--------------------------------------------------------------------------
    | Configured Addon Directories
    |--------------------------------------------------------------------------
    |
    | These manually defined addon paths can be helpful
    | when you need to push an addon path into load
    | that is shipped IN another addon.
    |
    */

    'directories' => [
        //my-bundle'
    ],

    /*
    |--------------------------------------------------------------------------
    | Eager Loaded Addons
    |--------------------------------------------------------------------------
    |
    | Eager loaded addons are registered first and can be defined
    | here by specifying their relative path to the project root.
    |
    */

    'eager' => [
        //'core/anomaly/redirects-module'
    ],

    /*
    |--------------------------------------------------------------------------
    | Deferred Addons
    |--------------------------------------------------------------------------
    |
    | Deferred loaded addons are registered last and can be defined
    | here by specifying their relative path to the project root.
    |
    */

    'deferred' => [
        //'core/anomaly/pages-module'
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoload Addons
    |--------------------------------------------------------------------------
    |
    | Disable autoloading on the fly to improve performance.
    | Requires registering addons as local composer packages.
    |
    */

    'autoload' => env('STREAMS_ADDONS_AUTOLOAD', true),
];
