<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP CACHE ENABLED
    |--------------------------------------------------------------------------
    |
    | Do you want to enable HTTP caching?
    |
    */

    'enabled' => env('HTTP_CACHE', false),

    /*
    |--------------------------------------------------------------------------
    | DEFAULT TTL
    |--------------------------------------------------------------------------
    |
    | What is the default TTL value (seconds)?
    |
    */

    'ttl' => env('HTTP_CACHE_TTL', 3600),

    /*
    |--------------------------------------------------------------------------
    | EXCLUDED PATHS
    |--------------------------------------------------------------------------
    |
    | Specify cache-excluded paths.
    | Use * for partial matching.
    |
    */

    'excluded' => [
        '/advs/create_adv',
        '/advs/edit_advs/*',
        '/profile',
        '/profile/*',
        '/ajax/*',
    ],

    /*
    |--------------------------------------------------------------------------
    | TIMEOUT RULES
    |--------------------------------------------------------------------------
    |
    | Specify timeout rules per path.
    | Use * for partial matching.
    |
    */

    'rules' => explode(',', env('HTTP_CACHE_RULES', '')),

];
