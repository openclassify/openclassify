<?php

return [
    'name'                  => [
        'name'         => 'Namn',
        'instructions' => 'Vad ska den här rollen heta?',
        'placeholder'  => 'Redaktör',
    ],
    'first_name'            => [
        'name'         => 'Förnamn',
        'instructions' => 'Vad är användarens förnamn?',
        'placeholder'  => 'Joel',
    ],
    'last_name'             => [
        'name'         => 'Efternamn',
        'instructions' => 'Vad är användarens efternamn?',
        'placeholder'  => 'Svensson',
    ],
    'display_name'          => [
        'name'         => 'Visningsnamn',
        'instructions' => 'Vad är användarens offentliga visningsnamn?',
        'placeholder'  => 'Joel Svensson',
    ],
    'username'              => [
        'name'         => 'Användarnamn',
        'instructions' => 'Vad är användarens användarnamn? Ingen annan användare får ha exakt samma användarnamn.',
        'placeholder'  => 'joelsvensson',
    ],
    'email'                 => [
        'name'             => 'E-post',
        'instructions'     => 'Vad är användarens e-postadress? Ingen annan användare får ha exakt samma e-postadres.',
        'instructions_alt' => 'Skriv in e-postadressen för ditt konto.',
        'placeholder'      => 'exempel@domain.com',
    ],
    'password'              => [
        'name'             => 'Lösenord',
        'instructions'     => 'Skriv in ett säkert lösenord för användarens konto.',
        'instructions_alt' => 'Skriv in ett säkert lösenord.',
    ],
    'password_confirmation' => [
        'name'             => 'Godkänn Lösenord',
        'instructions'     => 'Godkänn ditt nya lösenord.',
        'instructions_alt' => 'Godkänn ditt nya lösenord.',
    ],
    'slug'                  => [
        'name'         => 'Slug',
        'instructions' => 'Skriv in rollens slug. Sluggen är något som i huvudsak används under huven på systemet och det får inte finnas någon annan roll med samma slug.',
        'placeholder'  => 'redaktor',
    ],
    'roles'                 => [
        'name'         => 'Roller',
        'count'        => ':count roll(er)',
        'instructions' => 'Välj vilka roller som du vill ge användaren.',
    ],
    'permissions'           => [
        'name'  => 'Behörigheter',
        'count' => ':count Behörighet(er)',
    ],
    'last_activity_at'      => [
        'name' => 'Senaste Aktivitet',
    ],
    'status'                => [
        'name'     => 'Status',
        'active'   => 'Aktiv',
        'inactive' => 'Inaktiv',
        'enabled'  => 'Avstängd',
    ],
    'reset_code'            => [
        'name'         => 'Återställningskod',
        'instructions' => 'Skriv in återställningskoden som skickades till dig.',
    ],
    'activation_code'       => [
        'name'         => 'Aktiveringskod',
        'instructions' => 'Skriv in aktiveringskoden som skickades till dig.',
    ],
    'remember_me'           => [
        'name' => 'Kom ihåg mig',
    ],
];
