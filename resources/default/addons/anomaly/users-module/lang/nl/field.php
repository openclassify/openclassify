<?php

return [
    'name'             => [
        'name'         => 'Naam',
        'instructions' => [
            'roles' => 'Specificeer een korte beschrijving voor deze role.',
        ],

    ],
    'description'      => [
        'name'         => 'Omschrijving',
        'instructions' => [
            'roles' => 'Beschrijf deze role in het kort.',
        ],
    ],
    'first_name'       => [
        'name'         => 'Voornaam',
        'instructions' => 'Specificeer de voornaam van de gebruiker.',
    ],
    'last_name'        => [
        'name'         => 'Achternaam',
        'instructions' => 'Specificeer de achternaam van de gebruiker.',
    ],
    'display_name'     => [
        'name'         => 'Display Naam',
        'instructions' => 'Specificeer de display naam van de gebruiker.',
    ],
    'username'         => [
        'name'         => 'Gebruikersnaam',
        'instructions' => 'De gebruikersnaam wordt gebruikt om deze gebruiker uniek te identificeren en weergeven.',
    ],
    'email'            => [
        'name'         => 'Emailadres',
        'instructions' => 'Het emailadres wordt gebruikt om in te loggen.',
    ],
    'password'         => [
        'name'         => 'Wachtwoord',
        'instructions' => 'Specificeer een veilig wachtwoord van de gebruiker',
        'impersonate'  => 'Verifiëer aub je huidige wachtwoord om verder te gaan.',
    ],
    'confirm_password' => [
        'name' => 'Verifiëer wachtwoord',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'roles' => 'De slug wordt gebruikt om deze rol uniek te identificeren.',
        ],
    ],
    'roles'            => [
        'name'         => 'Roles',
        'instructions' => 'Specify which roles the user belongs to. Specificeer waarbij welke roles de gebruiker bij hoort.',
    ],
    'permissions'      => [
        'name' => 'Permissies',
    ],
    'last_activity_at' => [
        'name' => 'Laatste activiteit',
    ],
    'activated'        => [
        'name'         => 'Geactiveerd',
        'label'        => 'Is deze gebruiker geactiveerd?',
        'instructions' => 'Deze gebruiker kan niet inloggen tenzij het hier geactiveerd is.',
    ],
    'enabled'          => [
        'name'         => 'Ingeschakeld',
        'label'        => 'Is deze gebruiker ingeschakeld?',
        'instructions' => 'Deze gebruiker kan zijn/haar account niet activeren of inloggen tenzij het hier ingeschakeld is',
    ],
    'activation_code'  => [
        'name' => 'Activatie Code',
    ],
    'reset_code'       => [
        'name' => 'Reset Code',
    ],
    'remember_me'      => [
        'name' => 'Onthoud mij',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'active'   => 'Actief',
            'inactive' => 'Inactief',
            'disabled' => 'Uitgeschakeld',
        ],
    ],
];
