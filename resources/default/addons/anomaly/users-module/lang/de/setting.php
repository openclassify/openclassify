<?php

return [
    'login'                     => [
        'label'        => 'Login Feld',
        'instructions' => 'Welches Feld soll für den Login verwendet werden?',
        'option'       => [
            'email'    => 'E-Mail',
            'username' => 'Benutzername',
        ],
    ],
    'activation_mode'           => [
        'label'        => 'Aktivierungsmodus',
        'instructions' => 'Wie sollen Benutzer aktiviert werden nachdem Sie sich registriert haben?',
        'option'       => [
            'email'     => 'Schick eine Aktivierungsmail an den Benutzer.',
            'manual'    => 'Ein Administrator muss den Benutzer manuell aktivieren.',
            'automatic' => 'Aktiviere Benutzer automatisch nachdem Sie sich registriert haben.',
        ],
    ],
    'password_length'           => [
        'label'        => 'Passwortlänge',
        'instructions' => 'Geben sie die Minimallänge für das Passwort an.',
    ],
    'password_requirements'     => [
        'label'        => 'Passwortanforderungen',
        'instructions' => 'Geben Sie die Anforderungen für das Passwort an.',
        'option'       => [
            '[0-9]'        => 'Das Passwort muss mindestens eine Zahl enthalten.',
            '[a-z]'        => 'Das Passwort muss mindestens einen Kleinbuchstaben enthalten.',
            '[A-Z]'        => 'Das Passwort muss mindestens einen Großbuchstaben enthalten.',
            '[!@#$%^&*()]' => 'Das Passwort muss mindestens ein Sonderzeichen enthalten.',
        ],
    ],
    'new_user_notification'     => [
        'name'         => 'Benachrichtigungen für neue Benutzer.',
        'instructions' => 'Wer soll über neue Benutzer benachrichtigt werden?',
    ],
    'pending_user_notification' => [
        'name'         => 'Ausstehende Benutzer Benachrichtigungen',
        'instructions' => 'Wer soll über Benutzer benachrichtigt werden, die eine Aktivierung benötigen?',
    ],
];
