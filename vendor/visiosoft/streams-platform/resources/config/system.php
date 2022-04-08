<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Force SSL
    |--------------------------------------------------------------------------
    |
    | Force requests to use SSL
    |
    */

    'force_ssl' => env('FORCE_SSL', false),

    /*
    |--------------------------------------------------------------------------
    | Primary Domain
    |--------------------------------------------------------------------------
    |
    | Define the primary domain for the app.
    |
    */

    'domain' => env('APPLICATION_DOMAIN', config('app.url', 'localhost')),

    /*
    |--------------------------------------------------------------------------
    | Domain Prefix
    |--------------------------------------------------------------------------
    |
    | Normalize the domain prefix.
    |
    | Valid options are "ignore", "www", and "non-www".
    |
    */

    'domain_prefix' => env('DOMAIN_PREFIX', 'ignore'),

    /*
    |--------------------------------------------------------------------------
    | Results Per Page
    |--------------------------------------------------------------------------
    |
    | This is the global default number of results
    | to display on each page.
    |
    */

    'per_page' => env('RESULTS_PER_PAGE', 15),

    /*
    |--------------------------------------------------------------------------
    | Units of Measurement
    |--------------------------------------------------------------------------
    |
    | Which measurement system do you use? 'imperial' or 'metric'
    |
    */

    'unit_system' => env('UNIT_SYSTEM', 'imperial'),

    /*
    |--------------------------------------------------------------------------
    | Lazy Translations
    |--------------------------------------------------------------------------
    |
    | Do you want to guess strings for missing translation keys?
    |
    | By default generators will automate a suggested translation key
    | paradigm for you. Enabling this feature is helpful for rapidly
    | building and deploying addons that don't require fulfilled
    | translation files but can easily support them at a later
    | date if needed. With this feature disabled it is easy
    | to spot what translations need to be added still.
    |
    | Example:
    |
    | A field with the name key "anomaly.module.store::field.product_type.name"
    | would gracefully fallback to "Product Type" if the translation file has
    | not been included with the "product_type" field's name.
    |
    |
    */

    'lazy_translations' => env('LAZY_TRANSLATIONS', false),

    /*
    |--------------------------------------------------------------------------
    | LOCKING ENABLED
    |--------------------------------------------------------------------------
    |
    | Do you want to enable edit locks?
    |
    | Edit locks prevent multiple users from working on the same
    | content at the same time by locking forms to other users.
    |
    |
    */

    'locking_enabled' => env('LOCKING_ENABLED', true),


    /*
    |--------------------------------------------------------------------------
    | VERSIONING ENABLED
    |--------------------------------------------------------------------------
    |
    | Do you want to enable versioning?
    |
    | Versioning keeps tracks of changes made to versionable models.
    |
    |
    */

    'versioning_enabled' => env('VERSIONING_ENABLED', true),

];
