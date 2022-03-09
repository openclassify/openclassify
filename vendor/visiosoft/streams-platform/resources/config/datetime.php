<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Date/Time Format
    |--------------------------------------------------------------------------
    |
    | This is the default format of dates and times displayed.
    |
    */

    'date_format' => env('DATE_FORMAT', 'm/d/Y'),
    'time_format' => env('TIME_FORMAT', 'g:i A'),

    /*
    |--------------------------------------------------------------------------
    | Timezones
    |--------------------------------------------------------------------------
    |
    | Configure the various timezones used.
    |
    | Default: The default timezone for the application when none is set.
    | Database: The timezone of the database.
    |
    */

    'default_timezone'  => env('DEFAULT_TIMEZONE', date_default_timezone_get()),
    'database_timezone' => env('DATABASE_TIMEZONE', date_default_timezone_get()),
];
