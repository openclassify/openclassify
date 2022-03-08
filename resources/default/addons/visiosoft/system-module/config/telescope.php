<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Telescope Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable all Telescope watchers regardless
    | of their individual configuration, which simply provides a single
    | and convenient way to enable or disable Telescope data storage.
    |
    */

    'enabled' => env('TELESCOPE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Telescope Admin Monitoring
    |--------------------------------------------------------------------------
    |
    | This option is used to disable Telescope
    | watchers when accessing admin areas.
    |
    */

    'admin_enabled' => env('TELESCOPE_ADMIN_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Telescope Max Entries
    |--------------------------------------------------------------------------
    |
    | To prevent unintentional DB flooding please specify
    | a maximum number of allowed Telescope entries.
    |
    */

    'max_entries' => env('TELESCOPE_MAX_ENTRIES', 10000),

    /*
    |--------------------------------------------------------------------------
    | Ignored Paths & Commands
    |--------------------------------------------------------------------------
    |
    | The following array lists the URI paths and Artisan commands that will
    | not be watched by Telescope. In addition to this list, some Laravel
    | commands, like migrations and queue commands, are always ignored.
    |
    */

    'ignore_paths' => [
        //
    ],

    'ignore_commands' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Telescope Watchers
    |--------------------------------------------------------------------------
    |
    | The following array lists the UI components to use for the "watchers"
    | that will be registered with Telescope. The watchers gather the
    | application's profile data when a request or task is executed.
    |
    */

    'watchers' => [
         'views'      => [
             'enabled' => env('TELESCOPE_VIEW_WATCHER', true),
             'view'    => 'visiosoft.module.system::admin/views',
             'table'   => \Visiosoft\SystemModule\Telescope\Table\ViewTableBuilder::class,
             'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\ViewWatcher.enabled',
         ],
        'requests'      => [
            'enabled' => env('TELESCOPE_REQUEST_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/requests',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\RequestTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\RequestWatcher.enabled',
        ],
        'commands'      => [
            'enabled' => env('TELESCOPE_COMMAND_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/commands',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\CommandTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\CommandWatcher.enabled',
        ],
        'schedule'      => [
            'enabled' => env('TELESCOPE_SCHEDULE_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/schedule',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\ScheduleTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\ScheduleWatcher.enabled',
        ],
        'jobs'          => [
            'enabled' => env('TELESCOPE_JOB_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/jobs',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\JobsTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\JobWatcher.enabled',
        ],
        'exceptions'    => [
            'enabled' => env('TELESCOPE_EXCEPTION_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/exceptions',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\ExceptionTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\ExceptionWatcher.enabled',
        ],
        'logs'          => [
            'enabled' => env('TELESCOPE_LOG_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/logs',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\LogTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\LogWatcher.enabled',
        ],
        'dumps'         => [
            'enabled' => env('TELESCOPE_DUMP_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/dumps',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\DumpTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\DumpWatcher.enabled',
        ],
        'queries'       => [
            'enabled' => env('TELESCOPE_QUERY_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/queries',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\QueryTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\QueryWatcher.enabled',
        ],
        'models'        => [
            'enabled' => env('TELESCOPE_MODEL_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/models',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\ModelTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\ModelWatcher.enabled',
        ],
        'events'        => [
            'enabled' => env('TELESCOPE_EVENT_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/events',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\EventTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\EventWatcher.enabled',
        ],
        'mail'          => [
            'enabled' => env('TELESCOPE_MAIL_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/mail',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\MailTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\MailWatcher.enabled',
        ],
        'notifications' => [
            'enabled' => env('TELESCOPE_NOTIFICATION_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/notifications',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\NotificationTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\NotificationWatcher.enabled',
        ],
        'cache'         => [
            'enabled' => env('TELESCOPE_CACHE_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/cache',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\CacheTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\CacheWatcher.enabled',
        ],
        'redis'         => [
            'enabled' => env('TELESCOPE_REDIS_WATCHER', true),
            'view'    => 'visiosoft.module.system::admin/redis',
            'table'   => \Visiosoft\SystemModule\Telescope\Table\RedisTableBuilder::class,
            'key'     => 'telescope.watchers.Laravel\Telescope\Watchers\RedisWatcher.enabled',
        ],
    ],

    'enabled_watchers' => array_filter(explode(',', env('TELESCOPE_ENABLED_WATCHERS'))),

];
