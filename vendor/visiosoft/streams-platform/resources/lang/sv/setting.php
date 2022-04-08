<?php

return [
    'name'             => [
        'label'        => 'Webbsidenamn',
        'instructions' => 'Vilket namn har din webbsida?',
        'placeholder'  => trans('distribution::addon.name')
    ],
    'description'      => [
        'label'        => 'Sidbeskrivning',
        'instructions' => 'Vad är beskrivningen eller sloganen för webbsidan?',
        'placeholder'  => trans('distribution::addon.description')
    ],
    'business'          => [
        'label'        => 'Företagsnamn',
        'instructions' => 'Vad heter ditt företag?',
    ],
    'phone'             => [
        'label'        => 'Telefonnummer',
        'instructions' => 'Ange ett generellt telefonnummer',
    ],
    'address'           => [
        'label' => 'Adress',
    ],
    'address2'          => [
        'label' => 'Lägenhetsnummer, trappuppgång, etc.',
    ],
    'city'              => [
        'label' => 'Stad',
    ],
    'state'             => [
        'label' => 'Stat / Provins',
    ],
    'postal_code'       => [
        'label' => 'Postkod / ZIP-kod',
    ],
    'country'           => [
        'label' => 'Land',
    ],
    'timezone'          => [
        'label'        => 'Tidszon',
        'instructions' => 'Ange standard tidszon för din webbplats.',
    ],
    'unit_system'       => [
        'label'        => 'Enhetssystem',
        'instructions' => 'Ange enhetssystem för din webbplats.',
        'option'       => [
            'imperial' => 'Brittiska måttenheter',
            'metric'   => 'Metriska systemet',
        ],
    ],
    'currency'          => [
        'label'        => 'Valuta',
        'instructions' => 'Ange standard valuta för din webbplats',
    ],
    'default_timezone' => [
        'label'        => 'Standardtidszon',
        'instructions' => 'Specificera systemets standardtidszon. Detta kommer att användas för alla funktioner gällande datum och tid.'
    ],
    'date_format'      => [
        'label'        => 'Datumformat',
        'instructions' => 'Hur vill du att datum ska visas på webbsidan och kontrollpanelen? Utgå från att använda PHP:s <a href="http://php.net/manual/en/function.date.php" target="_blank">datumformat</a>.',
        'placeholder'  => 'Y-m-d'
    ],
    'time_format'      => [
        'label'        => 'Tidsformat',
        'instructions' => 'Hur vill du att tid ska visas på webbsidan och kontrollpanelen? Utgå från att använda PHP:s <a href="http://php.net/manual/en/function.date.php" target="_blank">datumformat</a>.',
        'placeholder'  => 'g:i A'
    ],
    'default_locale'   => [
        'label'        => 'Standardspråk',
        'instructions' => 'Vilket är standardspråket för din webbsida?'
    ],
    'enabled_locales'  => [
        'label'        => 'Påslagna Språk',
        'instructions' => 'Specificera vilka språk som ska vara tillgängliga för din webbsida.'
    ],
    'maintenance'       => [
        'label'        => 'Underhållsläge',
        'instructions' => 'Använd detta alternativ för att inaktivera den offentliga delen av systemet.<br>Detta är användbart när du vill underhålla eller utveckla din webbplats.',
    ],
    'debug'             => [
        'label'        => 'Felsökningsläge',
        'instructions' => 'När det är aktiverat, visas detaljerade meddelanden när fel uppstår.',
    ],
    'site_enabled'     => [
        'label'        => 'Sidan är aktiverad',
        'instructions' => 'Använd detta alternativet för att aktivera eller inaktivera den offentligt synliga delen av din webbsida.<br>Detta är användbart ifall du vill stänga av webbsidan för utveckling eller underhåll.'
    ],
    'ip_whitelist'     => [
        'label'        => 'IP Vitlista',
        'instructions' => 'När statusen är satt som "inaktiverad" kommer endast dessa IP-adresser få tillåtelse att komma åt webbsidan.',
        'placeholder'  => 'Separera varje IP-adress med ett kommatecken.'
    ],
    'basic_auth'        => [
        'label'        => 'Fråga efter autentisering?',
        'instructions' => 'När underhållsläge är aktiverat, fråga användare efter HTTP autentisering?',
    ],
    '503_message'      => [
        'label'        => 'Otillgänglighetsmeddelande',
        'instructions' => 'När sidan är inaktiverad eller ett stort problem har uppstått, kommer detta meddelandet att visas för besökarna.',
        'placeholder'  => 'Återkommer strax.'
    ],
    'force_https'      => [
        'label'        => 'Tvinga HTTPS',
        'instructions' => 'Tillåt endast åtkomst till sidan genom HTTPS?',
        'option'       => [
            'all'    => 'Tvinga HTTPS för alla anslutningar',
            'none'   => 'Tvinga INTE HTTPS för anslutningar',
            'admin'  => 'Tvinga endast HTTPS vid åtkomst av kontrollpanelen',
            'public' => 'Tvinga endast HTTPS för offentligt innehåll'
        ]
    ],
    'email'    => [
        'label'        => 'Kontaktmejl',
        'instructions' => 'All e-post från användare, gäster och webbsidan själv kommer att skickas till denna e-postadress som standard.',
        'placeholder'  => 'example@domain.com'
    ],
    'sender'     => [
        'label'        => 'Serverns E-post',
        'instructions' => 'All e-post som skickas från servern kommer att skickas från den här adressen.',
        'placeholder'  => 'inget-svar@domain.com'
    ],
    'mail_driver'      => [
        'label'        => 'E-postdrivrutin',
        'instructions' => 'Hur skickar webbsidan e-post?',
        'option'       => [
            'smtp'     => 'SMTP',
            'mail'     => 'PHP Mail',
            'sendmail' => 'Sendmail',
            'mailgun'  => 'Mailgun',
            'mandrill' => 'Mandrill',
            'log'      => 'Loggfil'
        ]
    ],
    'mail_host'        => [
        'label'        => 'SMTP-värd',
        'instructions' => 'Detta är adressen för SMTP-servern som ska leverera e-post.',
        'placeholder'  => 'smtp.mailgun.org'
    ],
    'mail_port'        => [
        'label'        => 'SMTP-port',
        'instructions' => 'Detta är porten för SMTP-servern som ska leverera e-post.',
        'placeholder'  => '587'
    ],
    'mail_username'    => [
        'label'        => 'SMTP-användarnamn',
        'instructions' => 'Detta är användarnamnet som används för att få åtkomst till SMTP-servern.'
    ],
    'mail_password'    => [
        'label'        => 'SMTP-lösenord',
        'instructions' => 'Detta är lösenordet som används för att få åtkomst till SMTP-servern.'
    ],
    'mail_debug'       => [
        'label'        => 'Debugläge',
        'instructions' => 'När detta alternativ är aktiverat kommer e-post inte att skickas utan kommer istället att skrivas till din webbsidas loggar så att du kan granska alla meddelanden.'
    ],
    'cache_driver'     => [
        'label'        => 'Cachedrivrutin',
        'instructions' => 'Hur lagras din cachade data?',
        'option'       => [
            'apc'       => 'APC',
            'array'     => 'Array',
            'file'      => 'Fil',
            'memcached' => 'Memcached',
            'redis'     => 'Redis'
        ]
    ],
    'standard_theme'   => [
        'label'        => 'Offentligt Tema',
        'instructions' => 'Vilket tema vill du använda för den offentliga webbsidan?'
    ],
    'admin_theme'      => [
        'label'        => 'Admintema',
        'instructions' => 'Vilket tema vill du använda för kontrollpanelen?'
    ],
    'per_page'          => [
        'label'        => 'Resultat Per Sida',
        'instructions' => 'Ange hur många resultat du skulle vilja visa per sida.',
    ],
];
