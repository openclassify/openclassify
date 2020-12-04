<?php

use App\Exceptions\ExceptionHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Listeners
    |--------------------------------------------------------------------------
    |
    | Register event listeners for Streams Platform to register.
    |
    */

    'listeners' => [],

    /*
    |--------------------------------------------------------------------------
    | Bindings
    |--------------------------------------------------------------------------
    |
    | Additional bindings for Streams Platform to register.
    |
    */

    'bindings' => [
        'Anomaly\Streams\Platform\Exception\ExceptionHandler' => ExceptionHandler::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Singletons
    |--------------------------------------------------------------------------
    |
    | Additional singletons for Streams Platform to register.
    |
    */

    'singletons' => [],

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | Additional service providers for Streams Platform to register.
    |
    */

    'providers' => [],

    /*
    |--------------------------------------------------------------------------
    | Commands
    |--------------------------------------------------------------------------
    |
    | Additional Artisan commands for Streams Platform to register.
    |
    */

    'commands' => [],

    /*
    |--------------------------------------------------------------------------
    | Schedules
    |--------------------------------------------------------------------------
    |
    | Additional scheduled commands for Streams Platform to register.
    |
    */

    'schedules' => [],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | The application's global HTTP middleware stack.
    | These middleware are run during every request to your application.
    | By default Laravel's default middleware stack will be ran.
    |
    */

    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Route middleware allows you to apply middleware to a group of routes.
    | By default Laravel's default route middleware will be registered.
    |
    */

    'route_middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Middleware Groups
    |--------------------------------------------------------------------------
    |
    | Sometimes you may want to group several middleware under a single
    | key to make them easier to assign to routes. You may define these here.
    | By default Laravel's default middleware groups will be registered.
    |
    */

    'middleware_groups' => [],

    /*
    |--------------------------------------------------------------------------
    | Middleware Groups
    |--------------------------------------------------------------------------
    |
    | The priority-sorted list of middleware.
    | Forces the listed middleware to always be in the given order.
    | By default Laravel's default middleware priority will be used.
    |
    */

    'middleware_priority' => [],

    /*
    |--------------------------------------------------------------------------
    | View Overrides
    |--------------------------------------------------------------------------
    |
    | Define globally overridden views as 'view' => 'override' view paths.
    |
    */

    'overrides' => [],

    /*
    |--------------------------------------------------------------------------
    | Control Panel Customization
    |--------------------------------------------------------------------------
    |
    | Support for control panel configuration is
    | currently limited to the Streams module.
    |
    */

    'cp' => [],

];
