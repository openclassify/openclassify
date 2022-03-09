<?php

return [
    'name'                  => [
        'env'         => 'APP_NAME',
        'bind'        => 'app.name',
        'type'        => 'anomaly.field_type.text',
        'placeholder' => config('streams::distribution.name'),
        'config'      => [
            'default_value' => config('streams::distribution.name'),
        ],
    ],
    'description'           => [
        'type'   => 'anomaly.field_type.text',
        'bind'   => 'app.description',
        'config' => [
            'default_value' => config('streams::distribution.description'),
        ],
    ],
    'domain'                => [
        'required' => true,
        'env'      => 'APPLICATION_DOMAIN',
        'bind'     => 'streams::system.domain',
        'type'     => 'anomaly.field_type.url',
        'config'   => [
            'default_value' => request()->getHttpHost(),
        ],
    ],
    'force_ssl'             => [
        'env'  => 'FORCE_SSL',
        'bind' => 'streams::system.force_ssl',
        'type' => 'anomaly.field_type.boolean',
    ],
    'domain_prefix'         => [
        'env'    => 'DOMAIN_PREFIX',
        'bind'   => 'streams::system.domain_prefix',
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'www'     => 'www.domain.com',
                'non-www' => 'domain.com',
            ],
        ],
    ],
    'timezone'              => [
        'env'    => 'APP_TIMEZONE',
        'bind'   => 'app.timezone',
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'mode'          => 'search',
            'handler'       => 'timezones',
            'default_value' => config('app.timezone'),
        ],
    ],
    'date_format'           => [
        'env'         => 'DATE_FORMAT',
        'bind'        => 'streams::datetime.date_format',
        'type'        => 'anomaly.field_type.select',
        'placeholder' => false,
        'required'    => true,
        'config'      => [
            'options' => [
                'j F, Y' => date('j F, Y'), // 10 July, 2015
                'j M, y' => date('j M, y'), // 10 Jul, 15
                'm/d/Y'  => date('m/d/Y'),  // 07/10/2015
                'd/m/Y'  => date('d/m/Y'),  // 10/07/2015
                'Y-m-d'  => date('Y-m-d'),  // 2015-07-10
                'd.m.Y'  => date('d.m.Y'),  // 10.07.2015
            ],
        ],
    ],
    'time_format'           => [
        'env'         => 'TIME_FORMAT',
        'bind'        => 'streams::datetime.time_format',
        'type'        => 'anomaly.field_type.select',
        'placeholder' => false,
        'required'    => true,
        'config'      => [
            'options' => [
                'g:i A' => date('g:i A'),   // 4:00 PM
                'g:i a' => date('g:i a'),   // 4:00 pm
                'H:i'   => date('H:i'),     // 16:00
            ],
        ],
    ],
    'unit_system'           => [
        'env'      => 'UNIT_SYSTEM',
        'bind'     => 'streams::system.unit_system',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => 'imperial',
            'options'       => [
                'imperial' => 'streams::setting.unit_system.option.imperial',
                'metric'   => 'streams::setting.unit_system.option.metric',
            ],
        ],
    ],
    'currency'              => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'handler'       => 'currencies',
            'default_value' => config('streams::currencies.default'),
        ],
    ],
    'standard_theme'        => [
        'env'      => 'STANDARD_THEME',
        'bind'     => 'streams::themes.standard',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => config('streams::themes.standard'),
            'handler'       => \Anomaly\Streams\Platform\Support\Config\StandardThemeHandler::class,
        ],
    ],
    'admin_theme'           => [
        'env'      => 'ADMIN_THEME',
        'bind'     => 'streams::themes.admin',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => config('streams::themes.admin'),
            'handler'       => \Anomaly\Streams\Platform\Support\Config\AdminThemeHandler::class,
        ],
    ],
    'per_page'              => [
        'env'      => 'RESULTS_PER_PAGE',
        'bind'     => 'streams::system.per_page',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => 15,
            'options'       => [
                5   => 5,
                10  => 10,
                15  => 15,
                25  => 25,
                50  => 50,
                75  => 75,
                100 => 100,
                150 => 150,
            ],
        ],
    ],
    'default_locale'        => [
        'env'      => 'DEFAULT_LOCALE',
        'bind'     => 'streams::locales.default',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'mode'          => 'search',
            'default_value' => config('streams::locales.default'),
            'handler'       => \Anomaly\Streams\Platform\Support\Config\DefaultLocaleHandler::class,
        ],
    ],
    'enabled_locales'       => [
        'env'      => 'ENABLED_LOCALES',
        'bind'     => 'streams::locales.enabled',
        'type'     => 'anomaly.field_type.checkboxes',
        'required' => true,
        'config'   => [
            'mode'          => 'tags',
            'default_value' => [config('streams::locales.default')],
            'handler'       => \Anomaly\Streams\Platform\Support\Config\EnabledLocalesHandler::class,
        ],
    ],
    'debug'                 => [
        'env'    => 'APP_DEBUG',
        'bind'   => 'app.debug',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => config('app.debug'),
            'on_text'       => 'ON',
            'off_text'      => 'OFF',
        ],
    ],
    'debug_bar'             => [
        'env'    => 'DEBUG_BAR',
        'bind'   => 'debugbar.enabled',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
            'on_text'       => 'ON',
            'off_text'      => 'OFF',
        ],
    ],
    'maintenance'           => [
        'type'   => 'anomaly.field_type.boolean',
        'env'    => 'MAINTENANCE_MODE',
        'bind'   => 'streams::maintenance.enabled',
        'config' => [
            'on_text'  => 'ON',
            'off_text' => 'OFF',
        ],
    ],
    'basic_auth'            => [
        'env'  => 'MAINTENANCE_AUTH',
        'bind' => 'streams::maintenance.auth',
        'type' => 'anomaly.field_type.boolean',
    ],
    'ip_whitelist'          => [
        'env'    => 'IP_WHITELIST',
        'bind'   => 'streams::maintenance.ip_whitelist',
        'type'   => 'anomaly.field_type.tags',
        'config' => [
            'filter' => 'FILTER_VALIDATE_IP',
        ],
    ],
    'email'                 => [
        'env'      => 'FROM_ADDRESS',
        'bind'     => 'mail.from.address',
        'type'     => 'anomaly.field_type.email',
        'required' => true,
        'config'   => [
            'default_value' => 'noreply@' . request()->getHost(),
        ],
    ],
    'sender'                => [
        'env'      => 'FROM_NAME',
        'bind'     => 'mail.from.name',
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => config('streams::distribution.name'),
        ],
    ],
    'mail_driver'           => [
        'env'      => 'MAIL_DRIVER',
        'bind'     => 'mail.driver',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'default_value' => 'mail',
            'options'       => [
                'smtp'     => 'streams::setting.mail_driver.option.smtp',
                'mail'     => 'streams::setting.mail_driver.option.mail',
                'sendmail' => 'streams::setting.mail_driver.option.sendmail',
                'mailgun'  => 'streams::setting.mail_driver.option.mailgun',
                'mandrill' => 'streams::setting.mail_driver.option.mandrill',
                'log'      => 'streams::setting.mail_driver.option.log',
            ],
        ],
    ],
    'mail_host'             => [
        'env'  => 'MAIL_HOST',
        'bind' => 'mail.host',
        'type' => 'anomaly.field_type.text',
    ],
    'mail_port'             => [
        'env'  => 'MAIL_PORT',
        'bind' => 'mail.port',
        'type' => 'anomaly.field_type.integer',
    ],
    'mail_username'         => [
        'env'  => 'MAIL_USERNAME',
        'bind' => 'mail.username',
        'type' => 'anomaly.field_type.text',
    ],
    'mail_password'         => [
        'env'    => 'MAIL_PASSWORD',
        'bind'   => 'mail.password',
        'type'   => 'anomaly.field_type.text',
        'config' => [
            'type' => 'password',
        ],
    ],
    'http_cache'            => [
        'env'    => 'HTTP_CACHE',
        'bind'   => 'streams::httpcache.enabled',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'http_cache_ttl'        => [
        'required' => true,
        'env'      => 'HTTP_CACHE_TTL',
        'bind'     => 'streams::httpcache.ttl',
        'type'     => 'anomaly.field_type.integer',
        'config'   => [
            'default_value' => 3600,
            'min'           => 60,
        ],
    ],
    'http_cache_allow_bots' => [
        'env'    => 'HTTP_CACHE_ALLOW_BOTS',
        'bind'   => 'streams::httpcache.allow_bots',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'http_cache_excluded'   => [
        'env'    => 'HTTP_CACHE_EXCLUDED',
        'bind'   => 'streams::httpcache.excluded',
        'type'   => 'anomaly.field_type.textarea',
        'config' => [
            'lines' => 10,
        ],
    ],
    'http_cache_rules'      => [
        'env'    => 'HTTP_CACHE_RULES',
        'bind'   => 'streams::httpcache.rules',
        'type'   => 'anomaly.field_type.textarea',
        'config' => [
            'lines' => 10,
        ],
    ],
    'db_cache'              => [
        'env'    => 'DB_CACHE',
        'bind'   => 'streams::database.cache',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'db_cache_ttl'          => [
        'required' => true,
        'env'      => 'DB_CACHE_TTL',
        'bind'     => 'streams::database.ttl',
        'type'     => 'anomaly.field_type.integer',
        'config'   => [
            'default_value' => 3600,
            'min'           => 60,
        ],
    ],
    'locking_enabled'       => [
        'env'    => 'LOCKING_ENABLED',
        'bind'   => 'streams::system.locking_enabled',
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
];
