<?php

return [
    'users'    => [
        'name'   => 'Utilisateurs',
        'option' => [
            'read'   => 'Peut accèder aux Utilisateurs ?',
            'write'  => 'Peut ajouter et modifier les utilisateurs ?',
            'delete' => 'Peut supprimer les utilisateurs ?',
        ],
    ],
    'roles'    => [
        'name'   => 'Rôles',
        'option' => [
            'read'   => 'Peut accèder aux Rôles ?',
            'write'  => 'Peut ajouter et modifier les rôles ?',
            'delete' => 'Peut supprimer les rôles ?',
        ],
    ],
    'fields'   => [
        'name'   => 'Champs',
        'option' => [
            'manage' => 'Peut gérer les champs personnalisés ?',
        ],
    ],
    'settings' => [
        'name'   => 'Paramètres',
        'option' => [
            'manage' => 'Peut gérer les paramètres du module ?',
        ],
    ],
];
