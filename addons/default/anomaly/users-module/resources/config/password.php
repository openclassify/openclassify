<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Minimum Length
    |--------------------------------------------------------------------------
    |
    | Specify the required minimum length for passwords.
    |
    */
    'minimum_length' => env('PASSWORD_LENGTH', 8),

    /*
    |--------------------------------------------------------------------------
    | Password Requirements
    |--------------------------------------------------------------------------
    |
    | Specify the security requirements for passwords.
    |
    */
    'requirements'   => [
        '[0-9]',
        '[a-z]',
        '[A-Z]',
        '[!@#$%^&*()]',
    ],
];
