<?php

return [
    'name'            => [
        'label'        => 'Sitenaam',
        'instructions' => 'Wat is de naam van je applicatie?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'     => [
        'label'        => 'Site omschrijving',
        'instructions' => 'Wat is de omschrijving of slogan van je applicatie?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'domain'                => [
        'label'        => 'Primair domein',
        'instructions' => 'Wat is de domeinnaam van je applicatie?',
        'placeholder'  => 'domein.nl',
    ],
    'force_ssl'             => [
        'label'        => 'Forceer SSL',
        'instructions' => 'Wil je SSL forceren voor alle inkomende verbindingen?',
    ],
    'domain_prefix'         => [
        'label'        => 'Domein prefix',
        'instructions' => 'Wil je een domein prefix forceren?',
        'placeholder'  => 'Geen voorkeur',
    ],
    'timezone'        => [
        'label'        => 'Tijdzone',
        'instructions' => 'Specificeer de standaard tijdzone voor je site.',
    ],
    'unit_system'     => [
        'label'        => 'Eenheidssysteem',
        'instructions' => 'Specificeer het eenheidssysteem voor je site.',
        'option'       => [
            'imperial' => 'Imperial Systeem',
            'metric'   => 'Metriek Stelsel',
        ],
    ],
    'currency'        => [
        'label'        => 'Valuta',
        'instructions' => 'Specificeer de standaard valuta voor je site.',
    ],
    'date_format'     => [
        'label'        => 'Datumformaat',
        'instructions' => 'Specificeer de standaard datumformaat voor je site.',
    ],
    'time_format'     => [
        'label'        => 'Tijdformaat',
        'instructions' => 'Specificeer de standaard tijdformaat voor je site.',
    ],
    'default_locale'  => [
        'label'        => 'Taal',
        'instructions' => 'Specificeer de standaard taal voor je site.',
    ],
    'enabled_locales' => [
        'label'        => 'Ingeschakelde talen',
        'instructions' => 'Specificeer welke talen beschikbaar zijn voor je site.',
    ],
    'maintenance'     => [
        'label'        => 'Onderhoudsmodus',
        'instructions' => 'Gebruik deze optie om het publieke deel van je applicatie uit te schakelen.<br>Dit is handig voor als je de site even niet beschikbaar wilt maken voor onderhoud of ontwikkeling.',
    ],
    'debug'           => [
        'label'        => 'Debug Modus',
        'instructions' => 'Als dit ingeschakeld is worden er gedetailleerde berichten weergegeven bij errors.',
    ],
    'ip_whitelist'    => [
        'label'        => 'IP Whitelist',
        'instructions' => 'Als de onderhoudsmodus aan staat, deze IP addressen toestaan om het publieke deel van de applicatie weer te laten geven.',
        'placeholder'  => 'Scheid elk IP-adres met een komma.',
    ],
    'basic_auth'      => [
        'label'        => 'Vraag om authenticatie?',
        'instructions' => 'Als onderhoudsmodus ingeschakeld is, vraag gebruikers voor HTTP authenticatie?',
    ],
    '503_message'     => [
        'label'        => 'Onbeschikbaar bericht',
        'instructions' => 'Als de site uitgeschakeld of er een groot probleem is, wordt dit bericht voor alle gebruikers weergegeven.',
        'placeholder'  => 'We zijn ieder moment weer terug online.',
    ],
    'email'           => [
        'label'        => 'Systeem Email',
        'instructions' => 'Specificeer het standaard emailadres dat wordt gebruikt voor systeem gegenereerde berichten.',
        'placeholder'  => 'voorbeeld@domein.nl',
    ],
    'sender'          => [
        'label'        => 'Naam afzender',
        'instructions' => 'Specificeer de "Van" naam om te gebruiken voor systeem gegenereerde berichten.',
    ],
    'standard_theme'  => [
        'label'        => 'Publieke Thema',
        'instructions' => 'Welk thema wil je gebruiken voor de publieke site?',
    ],
    'admin_theme'     => [
        'label'        => 'Admin Thema',
        'instructions' => 'Welk thema wil je gebruiken voor het controlepaneel?',
    ],
    'per_page'        => [
        'label'        => 'Resultaten per pagina',
        'instructions' => 'Specificeer het standaard aantal resultaaten om te weergeven op elke pagina.',
    ],
    'per_page'              => [
        'label'        => 'Resultaten per pagina',
        'instructions' => 'Specificeer het standaard aantal resultaten om te weergeven per pagina.',
    ],
    'mail_driver'           => [
        'label'        => 'Email Driver',
        'instructions' => 'Hoe verzend jouw applicatie mail?',
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
        'instructions' => 'Specificeer de SMTP host.',
        'placeholder'  => 'smtp.mailgun.org',
    ],
    'mail_port'             => [
        'label'        => 'SMTP Port',
        'instructions' => 'Specificeer de SMTP port.',
        'placeholder'  => '587',
    ],
    'mail_username'         => [
        'label'        => 'SMTP Username',
        'instructions' => 'Specificeer de SMTP gebruikersnaam.',
    ],
    'mail_password'         => [
        'label'        => 'SMTP Password',
        'instructions' => 'Specificeer het SMTP wachtwoord.',
    ],
    'http_cache'            => [
        'label'        => 'HTTP Cache',
        'instructions' => 'Wil je HTTP Cache inschakelen?',
        'warning'      => 'Uitschakelen wist alle HTTP Cache opslag.',
    ],
    'http_cache_ttl'        => [
        'label'        => 'Standaard TTL',
        'instructions' => 'Specificeer de standaard cache tijd in seconden.',
    ],
    'http_cache_allow_bots' => [
        'label'        => 'Bot Policy',
        'instructions' => 'Laat bots cache bestanden <em>genereren</em>?',
        'warning'      => 'Bots zullen nog steeds vorig gegenereerde Cache bestanden inzien.',
    ],
    'http_cache_excluded'   => [
        'label'        => 'Uitgesloten paden',
        'instructions' => 'Specificeer elk pad op een nieuwe regel. Gebruik "*" voor partial matching.',
        'placeholder'  => '/account/*',
    ],
    'http_cache_rules'      => [
        'label'        => 'Timeout regels',
        'instructions' => 'Specificeer elk <strong>pad TTL</strong> op een nieuwe regel. Gebruik "*" voor partial matching.',
        'placeholder'  => '/news/* 1800',
    ],
    'db_cache'              => [
        'label'        => 'Database Cache',
        'instructions' => 'Wil je database query caching inschakelen?',
    ],
    'db_cache_ttl'          => [
        'label'        => 'Standaard TTL',
        'instructions' => 'Specificeer de standaard cache tijd in seconden.',
    ],
];
