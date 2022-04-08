<?php

return [
    'name'                  => [
        'label'        => 'Site Name',
        'instructions' => 'What is the name of your application?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'           => [
        'label'        => 'Site Description',
        'instructions' => 'What is the description or slogan of your application?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'domain'                => [
        'label'        => 'Primary Domain',
        'instructions' => 'What is the primary of your application?',
        'placeholder'  => 'domain.com',
    ],
    'force_ssl'             => [
        'label'        => 'Force SSL',
        'instructions' => 'Do you want to force SSL for all incoming connections?',
    ],
    'domain_prefix'         => [
        'label'        => 'Domain Prefix',
        'instructions' => 'Do you want to force a domain prefix?',
        'placeholder'  => 'No-preference',
    ],
    'timezone'              => [
        'label'        => 'Timezone',
        'instructions' => 'Specify the default timezone for your site.',
    ],
    'unit_system'           => [
        'label'        => 'Unit System',
        'instructions' => 'Specify the unit system for your site.',
        'option'       => [
            'imperial' => 'Imperial System',
            'metric'   => 'Metric System',
        ],
    ],
    'currency'              => [
        'label'        => 'Currency',
        'instructions' => 'Specify the default currency for your site.',
    ],
    'date_format'           => [
        'label'        => 'Date Format',
        'instructions' => 'Specify the default date format for your site.',
    ],
    'time_format'           => [
        'label'        => 'Time Format',
        'instructions' => 'Specify the default time format for your site.',
    ],
    'default_locale'        => [
        'label'        => 'Language',
        'instructions' => 'Specify the default language for your site.',
    ],
    'enabled_locales'       => [
        'label'        => 'Enabled Languages',
        'instructions' => 'Specify which languages are available for your site.',
    ],
    'maintenance'           => [
        'label'        => 'Maintenance Mode',
        'warning'      => 'Only admin users will be able to access the site.',
        'instructions' => 'Use this option to the disable the public-facing part of the system.<br>This is useful when you want to take the site down for maintenance or development.',
    ],
    'debug'                 => [
        'label'        => 'Debug Mode',
        'instructions' => 'When enabled, detailed messages will be displayed on errors.',
    ],
    'debug_bar'             => [
        'label'        => 'Debug Bar',
        'instructions' => 'When enabled, detailed request logs will be displayed at the bottom of the screen.',
    ],
    'ip_whitelist'          => [
        'label'        => 'IP Whitelist',
        'instructions' => 'When maintenance mode is enabled, these IP addresses will be allowed to access the front of the application.',
        'placeholder'  => 'Separate each IP address with a comma.',
    ],
    'basic_auth'            => [
        'label'        => 'Prompt for authentication?',
        'instructions' => 'When maintenance mode is enabled, prompt users for HTTP authentication?',
    ],
    '503_message'           => [
        'label'        => 'Unavailable Message',
        'instructions' => 'When the site is disabled or there is a major problem, this message will display to users.',
        'placeholder'  => 'Be right back.',
    ],
    'email'                 => [
        'label'        => 'System Email',
        'instructions' => 'Specify the default email to use for system generated messages.',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'                => [
        'label'        => 'Sender Name',
        'instructions' => 'Specify the "From" name to use for system generated messages.',
    ],
    'standard_theme'        => [
        'label'        => 'Public Theme',
        'instructions' => 'What theme would you like to use for the public site?',
    ],
    'admin_theme'           => [
        'label'        => 'Admin Theme',
        'instructions' => 'What theme would you like to use for the control panel?',
    ],
    'per_page'              => [
        'label'        => 'Results Per Page',
        'instructions' => 'Specify the default number of results to display on each page.',
    ],
    'mail_driver'           => [
        'label'        => 'Email Driver',
        'instructions' => 'How does your application send email?',
        'option'       => [
            'smtp'     => 'SMTP',
            'mail'     => 'PHP Mail',
            'sendmail' => 'Sendmail',
            'mailgun'  => 'Mailgun',
            'mandrill' => 'Mandrill',
            'log'      => 'Log File',
        ],
    ],
    'mail_host'             => [
        'label'        => 'SMTP Host',
        'instructions' => 'Specify the SMTP host to use.',
        'placeholder'  => 'smtp.mailgun.org',
    ],
    'mail_port'             => [
        'label'        => 'SMTP Port',
        'instructions' => 'Specify the SMTP port to use.',
        'placeholder'  => '587',
    ],
    'mail_username'         => [
        'label'        => 'SMTP Username',
        'instructions' => 'Specify the SMTP username to use.',
    ],
    'mail_password'         => [
        'label'        => 'SMTP Password',
        'instructions' => 'Specify the SMTP password to use.',
    ],
    'http_cache'            => [
        'label'        => 'HTTP Cache',
        'instructions' => 'Do you want to enable HTTP cache?',
        'warning'      => 'Disabling clears HTTP cache storage.',
    ],
    'http_cache_ttl'        => [
        'label'        => 'Default TTL',
        'instructions' => 'Specify the default cache time in seconds.',
    ],
    'http_cache_allow_bots' => [
        'label'        => 'Bot Policy',
        'instructions' => 'Allow bots to <em>generate</em> cache files?',
        'warning'      => 'Bots will still be served previously generated cache files.',
    ],
    'http_cache_excluded'   => [
        'label'        => 'Excluded Paths',
        'instructions' => 'Specify each path on a new line. Use "*" for partial matching.',
        'placeholder'  => '/account/*',
    ],
    'http_cache_rules'      => [
        'label'        => 'Timeout Rules',
        'instructions' => 'Specify each <strong>path TTL</strong> on a new line. Use "*" for partial matching.',
        'placeholder'  => '/news/* 1800',
    ],
    'db_cache'              => [
        'label'        => 'Database Cache',
        'instructions' => 'Do you want to enable database query caching?',
    ],
    'db_cache_ttl'          => [
        'label'        => 'Default TTL',
        'instructions' => 'Specify the default cache time in seconds.',
    ],
    'locking_enabled'       => [
        'label'        => 'Content Locking',
        'instructions' => 'Prevent multiple users from modifying the same content at once?',
    ],
];
