<?php

return [
    'name'             => [
        'label'        => 'Name der Website',
        'instructions' => 'Was ist der Name Ihrer Website?',
        'placeholder'  => trans('distribution::addon.name')
    ],
    'description'      => [
        'label'        => 'Beschreibung der Website',
        'instructions' => 'Was ist der Slogan oder eine kurze Beschreibung Ihrer Website?',
        'placeholder'  => trans('distribution::addon.description')
    ],
    'timezone'        => [
        'label'        => 'Zeitzone',
        'instructions' => 'Geben Sie die Standardzeitzone für Ihre Webseite an.',
    ],
    'unit_system'     => [
        'label'        => 'Einheitensystem',
        'instructions' => 'Geben Sie das Einheitensystem für Ihre Webseite an.',
        'option'       => [
            'imperial' => 'Angloamerikanisches System',
            'metric'   => 'Metrisches System',
        ],
    ],
    'currency'        => [
        'label'        => 'Währung',
        'instructions' => 'Geben Sie die Standardwährung für Ihre Website an.',
    ],
    'date_format'      => [
        'label'        => 'Datumsformat',
        'instructions' => 'Geben Sie das Standard-Datumsformat für Ihre Webseite an.',
    ],
    'time_format'      => [
        'label'        => 'Zeitformat',
        'instructions' => 'Geben Sie das Standard-Zeitformat für Ihre Webseite an.',
    ],
    'default_locale'   => [
        'label'        => 'Sprache',
        'instructions' => 'Geben Sie die Standardsprache für Ihre Webseite an.'
    ],
    'enabled_locales'  => [
        'label'        => 'Aktivierte Sprachen',
        'instructions' => 'Geben Sie an, welche Sprachen für Ihre Website verfügbar sein sollen.'
    ],
    'maintenance'     => [
        'label'        => 'Wartungsmodus',
        'instructions' => 'Verwenden Sie diese Option, um den öffentlichen Teil des Systems zu deaktivieren.<br> Dies ist nützlich, wenn Sie die Webseite für Wartung oder Entwicklung herunterfahren möchten.',
    ],
    'debug'           => [
        'label'        => 'Debug Modus',
        'instructions' => 'Wenn diese Option aktiviert ist, werden detaillierte Meldungen bei Fehlern angezeigt.',
    ],
    'debug_bar'       => [
        'label'        => 'Debug Leiste',
        'instructions' => 'Wenn aktiviert Wird eine Debug Leiste mit detaillierten Informationen am unteren Bildschirmrand angezeigt.',
    ],
    'ip_whitelist'     => [
        'label'        => 'IP Whitelist',
        'instructions' => 'Wenn Ihre Site auf "deaktiviert" gesetzt ist, können diese IP-Adressen weiterhin auf die Website zugreifen.',
        'placeholder'  => 'Trennen Sie jeden IP-Adresse mit einem Komma.'
    ],
    'basic_auth'      => [
        'label'        => 'Aufforderung zur Authentifizierung?',
        'instructions' => ' Sollen Benutzer zur HTTP-Authentifizierung aufgefordert werden, wenn der Wartungsmodus aktiviert ist?',
    ],
    '503_message'      => [
        'label'        => 'Nachricht, wenn die Website nicht verfügbar ist',
        'instructions' => 'Wenn die Website deaktiviert oder ein grosses Problem aufgetreten ist, wird diese Meldung angezeigt.',
        'placeholder'  => 'Wir sind gleich zurück.'
    ],
    'email'           => [
        'label'        => 'System E-Mail',
        'instructions' => 'Geben Sie die Standard-E-Mail an, die für systemgenerierte Nachrichten verwendet werden soll.',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'          => [
        'label'        => 'Absender Name',
        'instructions' => 'Geben Sie den Absendernamen an, der für systemgenerierte Nachrichten verwendet werden soll.',
    ],
    'standard_theme'   => [
        'label'        => 'Öffentliches Theme',
        'instructions' => 'Welches Theme möchten Sie für den öffentlichen Teil der Website verwenden?'
    ],
    'admin_theme'      => [
        'label'        => 'Admin Theme',
        'instructions' => 'Welches Theme soll für das Control Panel verwendet werden?'
    ],
    'per_page'         => [
        'label'        => 'Ergebnisse pro Seite',
        'instructions' => 'Geben Sie die Anzahl der Ergebnisse an, die Sie pro Seite anzeigen möchten.'
    ]
];
