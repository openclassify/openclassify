<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Eager Addons
    |--------------------------------------------------------------------------
    |
    | Eager loaded addons are registered first and can be defined
    | here by specifying their relative path to the addon's root.
    |
    */

    'eager' => [
        'vendor/anomaly/settings-module',
        'vendor/anomaly/preferences-module',
    ],

    /*
    |--------------------------------------------------------------------------
    | Deferred Addons
    |--------------------------------------------------------------------------
    |
    | Deferred addons are registered last and can be defined
    | here by specifying their relative path to the addon's root.
    |
    */

    'deferred' => [
        'vendor/anomaly/pages-module',
        'vendor/anomaly/redirects-module',
        'vendor/visiosoft/advs-module',
    ]

];
