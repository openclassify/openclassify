<?php

return [

    'url_base' => env('POSTS_URL_BASE', 'posts'),

    /*
    |--------------------------------------------------------------------------
    | Date Format
    |--------------------------------------------------------------------------
    |
    | Specify the date format for publish_at
    | values in the routable array.
    |
    | i.e. year => 'Y'
    |
    | You can also define additional keys to include
    | in the routable array.
    |
    | i.e. year => "format" // Adds {publish_at_year} to routable array:
    |
    | "posts/{publish_at_year}/{slug}" => route information
    |
    | NOTE THAT BECAUSE FORMATS ARE DEFINED HERE THEY
    | WILL NOT BE INCLUDED IN THE PERMALINKS.
    |
    | You will still need to override the route as desired.
    |
    */
    'format' => [
        'year'  => 'Y',
        'month' => 'm',
        'day'   => 'd',
    ],
];
