<?php

return [
    'name'             => [
        'name'         => 'Nom',
        'instructions' => [
            'roles' => 'Choisissez un nom pour ce rôle.',
        ],
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'roles' => 'Décrivez ce rôle.',
        ],
    ],
    'first_name'       => [
        'name'         => 'Prénom',
        'instructions' => 'Entrez le prénom de l\'utilisateur.',
    ],
    'last_name'        => [
        'name'         => 'Nom',
        'instructions' => 'Entrez le nom de l\'utilisateur.',
    ],
    'display_name'     => [
        'name'         => 'Nom affiché',
        'instructions' => 'Entrez le nom publiquement affiché de l\'utilisateur.',
    ],
    'username'         => [
        'name'         => 'Nom d\'utilisateur',
        'instructions' => 'Le nom d\'utilisateur est utilisé pour identifier de manière unique l\'utilisateur.',
    ],
    'email'            => [
        'name'         => 'Email',
        'instructions' => 'Email de l\'utilisateur. Utilisé pour se connecter.',
    ],
    'password'         => [
        'name'         => 'Mot de passe',
        'instructions' => 'Choisissez un mot de passe sécurisé pour l\'utilisateur.',
    ],
    'confirm_password' => [
        'name' => 'Confirmer mot de passe',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'roles' => 'Le slug est utilisé pour identifier de manière unique le rôle.',
        ],
    ],
    'roles'            => [
        'name'         => 'Rôles',
        'instructions' => 'Choisissez quel rôle à l\'utilisateur.',
    ],
    'permissions'      => [
        'name' => 'Permissions',
    ],
    'last_activity_at' => [
        'name' => 'Dernière activité',
    ],
    'activated'        => [
        'name'         => 'Actif',
        'label'        => 'Est-ce que l\'utilisateur est actif ?',
        'instructions' => 'L\'utilisateur ne pourra pas se connecter tant qu\'il n\'est pas actif.',
    ],
    'enabled'          => [
        'name'         => 'Activé',
        'label'        => 'Est-ce que l\'utilisateur est activé ?',
        'instructions' => 'L\'utilisateur ne pourra pas se connecter ni même activer son compte tant qu\'il n\'est pas activé.',
    ],
    'activation_code'  => [
        'name' => 'Code d\'activation',
    ],
    'remember_me'      => [
        'name' => 'Se souvenir de moi',
    ],
    'status'           => [
        'name'   => 'Statut',
        'option' => [
            'active'   => 'Actif',
            'inactive' => 'Inactif',
            'disabled' => 'Désactivé',
        ],
    ],
];
