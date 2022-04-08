<?php

return [
    'allow_registration' => [
        'label'        => 'Tillåt Registrering',
        'instructions' => 'Tillåt användare att registrera sig själva genom webbsidan?',
        'text'         => 'Ja, tillåt öppen registrering av användare',
    ],
    'activation_mode'    => [
        'label'        => 'Aktiveringsläge',
        'instructions' => 'Hur ska användare aktiveras efter att de har registrerat sig?',
        'option'       => [
            'manual'    => 'Kräv att en administratör manuellt aktiverar användaren.',
            'email'     => 'Skicka ett aktiveringsmejl till användaren.',
            'automatic' => 'Aktivera användaren automatiskt efter registrering.',
        ],
    ],
    'profile_visibility' => [
        'label'        => 'Profilsynlighet',
        'instructions' => 'Specificera vem som kan se användarprofiler på den offentliga webbsidan.',
        'option'       => [
            'everyone' => 'Alla kan titta på offentliga användarprofiler.',
            'owner'    => 'Bara profilägaren själv kan se sin profil.',
            'disabled' => 'Inaktivera detta.',
            'users'    => 'Alla inloggade användare kan se andra användares profiler.',
        ],
    ],
];
