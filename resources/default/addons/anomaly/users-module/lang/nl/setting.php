<?php

return [
    'login'                 => [
        'label'        => 'Login Veld',
        'instructions' => 'Which field should be used for logging in? Welk veld moet gebruikt worden om in te loggen?',
        'option'       => [
            'email'    => 'Emailadres',
            'username' => 'Gebruikersnaam',
        ],
    ],
    'activation_mode'       => [
        'label'        => 'Activatie Modus',
        'instructions' => 'Hoe moeten gebruikers geactiveerd worden nadat ze zich geregistreerd hebben?',
        'option'       => [
            'email'     => 'Verzend een activatiemail naar de gebruiker.',
            'manual'    => 'Vereis dat een administrator nieuwe gebruikers handmatig moet activeren.',
            'automatic' => 'Activeer de nieuwe gebruiker automatisch nadat ze geregisteerd zijn.',
        ],
    ],
    'password_length'       => [
        'label'        => 'Wachtwoordlengte',
        'instructions' => 'Specificeer de minimale lengte voor wachtwoorden.',
    ],
    'password_requirements' => [
        'label'        => 'Wachtwoordvereisten',
        'instructions' => 'Specificeer de karakter vereisten voor wachtwoorden.',
        'option'       => [
            '[0-9]'        => 'Het wachtwoord moet minstens één cijfer bevatten.',
            '[a-z]'        => 'Het wachtwoord moet minstens één kleine letter bevatten.',
            '[A-Z]'        => 'Het wachtwoord moet minstens één hoofdletter bevatten.',
            '[!@#$%^&*()]' => 'Het wachtwoord moet minstens één speciale karakter bevatten.',
        ],
    ],
];
