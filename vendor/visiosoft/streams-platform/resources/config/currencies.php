<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled Currencies
    |--------------------------------------------------------------------------
    |
    | Define an array of currencies enabled for translatable input.
    |
    */

    'enabled' => explode(',', env('ENABLED_CURRENCIES', 'USD')),

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | The default currency will be used if one can not
    | be determined automatically.
    |
    */

    'default' => env('DEFAULT_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | Supported Currencies
    |--------------------------------------------------------------------------
    |
    | In order to enable a currency or use it at all
    | the ISO currency code MUST be in this array.
    |
    */

    'supported' => [
        'USD' => [
            'name'      => 'US Dollar',
            'direction' => 'ltr',
            'symbol'    => '$',
            'separator' => ',',
            'point'     => '.',
            'decimals'  => 2,
        ],
    ],
];
