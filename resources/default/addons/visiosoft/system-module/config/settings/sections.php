<?php

return [
    'system'     => [
        'fields' => [
            'telescope_enabled',
            'admin_enabled',
            'ignore_paths',
            'enabled_watchers',
            'max_entries',
        ],
    ],
    'monitoring' => [
        'stacked' => true,
        'tabs'    => [
            'requests'      => [
                'title'  => 'visiosoft.module.system::tab.requests',
                'fields' => [
                    'requests_ignore_paths',
                    'requests_include_paths',
                ],
            ],
            'commands'      => [
                'title'  => 'visiosoft.module.system::tab.commands',
                'fields' => [
                    'commands_enabled',
                ],
            ],
            'schedule'      => [
                'title'  => 'visiosoft.module.system::tab.schedule',
                'fields' => [
                    'schedule_enabled',
                ],
            ],
            'jobs'          => [
                'title'  => 'visiosoft.module.system::tab.jobs',
                'fields' => [
                    'jobs_enabled',
                ],
            ],
            'exceptions'    => [
                'title'  => 'visiosoft.module.system::tab.exceptions',
                'fields' => [
                    'exceptions_enabled',
                ],
            ],
            'logs'          => [
                'title'  => 'visiosoft.module.system::tab.logs',
                'fields' => [
                    'logs_enabled',
                ],
            ],
            'dumps'         => [
                'title'  => 'visiosoft.module.system::tab.dumps',
                'fields' => [
                    'dumps_enabled',
                ],
            ],
            'queries'       => [
                'title'  => 'visiosoft.module.system::tab.queries',
                'fields' => [
                    'queries_enabled',
                ],
            ],
            'models'        => [
                'title'  => 'visiosoft.module.system::tab.models',
                'fields' => [
                    'models_enabled',
                ],
            ],
            'events'        => [
                'title'  => 'visiosoft.module.system::tab.events',
                'fields' => [
                    'events_enabled',
                ],
            ],
            'mail'          => [
                'title'  => 'visiosoft.module.system::tab.mail',
                'fields' => [
                    'mail_enabled',
                ],
            ],
            'notifications' => [
                'title'  => 'visiosoft.module.system::tab.notifications',
                'fields' => [
                    'notifications_enabled',
                ],
            ],
            'cache'         => [
                'title'  => 'visiosoft.module.system::tab.cache',
                'fields' => [
                    'cache_enabled',
                ],
            ],
//            'redis'         => [
//                'title'  => 'visiosoft.module.system::tab.redis',
//                'fields' => [
//                    'redis_enabled',
//                ],
//            ],
        ],
    ],
];
