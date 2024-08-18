<?php

return [
    'login'                     => [
        'label'        => 'Champ d\'identification',
        'instructions' => 'Quel champ doit être utilisé pour se connecter ?',
        'option'       => [
            'email'    => 'Email',
            'username' => 'Nom d\'utilisateur',
        ],
    ],
    'activation_mode' => [
        'label'        => 'Mode d\'activation',
        'instructions' => 'Comment les utilisateurs sont activés après inscription ?',
        'option'       => [
            'email'     => 'Envoyer un email d\'activation à l\'utilisateur.',
            'manual'    => 'Activer manuellement les nouveaux utilisateurs par un administrateur.',
            'automatic' => 'Activer automatiquement après inscription.',
        ],
    ],
    'password_length'           => [
        'label'        => 'Longueur du mot de passe',
        'instructions' => 'Spécifier la longueur minimum des mots de passe.',
    ],
    'password_requirements'     => [
        'label'        => 'Obligations du mot de passe',
        'instructions' => 'Spécifier les obligations de caractère des mot de passe.',
        'option'       => [
            '[0-9]'        => 'Le mot de passe doit contenir au moins un nombre.',
            '[a-z]'        => 'Le mot de passe doit contenir au moins une lettre en minuscule.',
            '[A-Z]'        => 'Le mot de passe doit contenir au moins une lettre en majuscule.',
            '[!@#$%^&*()]' => 'Le mot de passe doit contenir au moins un un caractère spécial.',
        ],
    ],
    'new_user_notification'     => [
        'name'         => 'Notification nouvel utilisateur',
        'instructions' => 'Qui doit être notifié des nouveaux utilisateurs ?',
    ],
    'pending_user_notification' => [
        'name'         => 'Notification utilisateur en attente',
        'instructions' => 'Qui doit être notifié des utilisateurs nécessitant une activation ?',
    ],
];
