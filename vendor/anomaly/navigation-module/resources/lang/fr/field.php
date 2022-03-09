<?php

return [
    'name'          => [
        'name'         => 'Nom',
        'instructions' => [
            'menus' => 'Nom de ce menu.',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Le slug permet de localiser ce menu.',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Ajoutez une brève description pour ce menu.',
    ],
    'target'        => [
        'name'         => 'Cible',
        'instructions' => 'Que se passe t-il quand ce lien est cliqué ?',
        'option'       => [
            'self'  => 'Ouverture dans la même fenêtre.',
            'blank' => 'Ouverture dans une nouvelle fenêtre.',
        ],
    ],
    'class'         => [
        'name'         => 'Class',
        'instructions' => 'Ajouter des classes spécifiques pour personnaliser ce lien.',
    ],
    'allowed_roles' => [
        'name'         => 'Rôles autorisés',
        'instructions' => 'Choisissez quels rôles utilisateur peuvent voir ce lien.',
        'warning'      => 'Si aucun rôle n\'est fourni, tout le monde pourra voir ce lien.', 
    ],
];
