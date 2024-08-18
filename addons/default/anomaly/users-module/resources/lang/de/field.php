<?php

return [
    'name'                  => [
        'name'         => 'Name',
        'instructions' => 'Was ist der Name dieser Rolle?',
        'placeholder'  => 'Editor',
    ],
    'first_name'            => [
        'name'         => 'Vorname',
        'instructions' => 'Wie lautet der Vorname des Benutzers?',
        'placeholder'  => 'Hans',
    ],
    'last_name'             => [
        'name'         => 'Nachname',
        'instructions' => 'Wie lautet der Nachname des Benutzers?',
        'placeholder'  => 'Müller',
    ],
    'display_name'          => [
        'name'         => 'Anzeigename',
        'instructions' => 'Wie lautet der öffentliche angezeigte Name dieses Benutzers?',
        'placeholder'  => 'Herr Hans Müller',
    ],
    'username'              => [
        'name'         => 'Benutzername',
        'instructions' => 'Wie lautet der Benutzername? Der Benutzername darf über alle Benutzer nur einmal vorkommen.',
        'placeholder'  => 'hansmueller1',
    ],
    'email'                 => [
        'name'             => 'E-Mail',
        'instructions'     => 'Wie lautet die E-Mail-Adresse des Benutzers? Die E-Mail-Adresse darf über alle Benutzer nur einmal vorkommen.',
        'instructions_alt' => 'Geben Sie die E-Mail-Adresse dieses Benutzerkontos an.',
        'placeholder'      => 'beispiel@domain.de',
    ],
    'password'              => [
        'name'             => 'Passwort',
        'instructions'     => 'Geben Sie ein sicheres Passwort für diesen Benutzer ein.',
        'instructions_alt' => 'Geben Sie ein neues, sicheres Passwort für diesen Benutzer ein.',
    ],
    'password_confirmation' => [
        'name'             => 'Passwort Bestätigung',
        'instructions'     => 'Bestätigen Sie das neue Passwort.',
        'instructions_alt' => 'Bestätigen Sie das neue Passwort.',
    ],
    'slug'                  => [
        'name'         => 'Slug',
        'instructions' => 'Geben Sie den &laquo;Slug&raquo; dieser Rolle ein. Der Slug wird hauptsächlich hinter den Kulissen verwendet, und darf über alle Rollen nur einmal vorkommen.',
        'placeholder'  => 'editor',
    ],
    'roles'                 => [
        'name'         => 'Rollen',
        'count'        => ':count Rolle(n)',
        'instructions' => 'Wählen Sie die Rolle(n) für diesen Benutzer aus.',
    ],
    'permissions'           => [
        'name'  => 'Berechtigungen',
        'count' => ':count Berechtigung(en)',
    ],
    'last_activity_at'      => [
        'name' => 'Letzte Aktivität',
    ],
    'status'                => [
        'name'     => 'Status',
        'active'   => 'Aktiv',
        'inactive' => 'Inaktiv',
        'enabled'  => 'Suspendiert',
    ],
    'reset_code'            => [
        'name'         => 'Code für die Zurücksetzung',
        'instructions' => 'Geben Sie den Code für die Zurücksetzung ein, der Ihnen zugesendet wurde.',
    ],
    'activation_code'       => [
        'name'         => 'Aktivierungscode',
        'instructions' => 'Geben Sie den Aktivierungscode ein, der Ihnen zugesendet wurde.',
    ],
    'remember_me'           => [
        'name' => 'Angemeldet bleiben',
    ],
];
