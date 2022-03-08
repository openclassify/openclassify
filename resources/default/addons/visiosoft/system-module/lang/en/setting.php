<?php

return [
    'telescope_enabled' => [
        'label'        => 'Monitoring Enabled',
        'instructions' => 'This is the monitoring system\'s "master switch".',
    ],
    'admin_enabled'     => [
        'label'        => 'Admin Monitoring',
        'instructions' => 'Enable to monitor admin traffic.',
        'warning'      => 'The System Module will still be omitted from monitoring.',
    ],
    'ignore_paths'      => [
        'label'        => 'Ignore Paths',
        'instructions' => 'Specify each URI path on a new line. Use "*" for partial matching.',
        'placeholder'  => '/account/*',
    ],
    'enabled_watchers'  => [
        'label'        => 'Enabled Watchers',
        'instructions' => 'Specify the monitoring watchers you would like to enabled.',
    ],
    'max_entries'       => [
        'label'        => 'Max Entries',
        'instructions' => 'To prevent unintentional database flooding please specify a maximum number of allowed monitoring entries.',
        'warning'      => 'Monitoring will disable itself completely once maximum entries are met.',
    ],

];
