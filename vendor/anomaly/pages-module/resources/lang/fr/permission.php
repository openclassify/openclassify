<?php

return [
    'pages'  => [
        'name'   => 'Pages',
        'option' => [
            'read'   => 'Peut voir les pages ?',
            'write'  => 'Peut modifier les pages ?',
            'delete' => 'Peut supprimer les pages ?',
        ],
    ],
    'types'  => [
        'name'   => 'Types',
        'option' => [
            'read'   => 'Peut accèder aux types de page ?',
            'write'  => 'Peut modifier les types de page ?',
            'delete' => 'Peut supprimer les types de page ?',
            'fields' => 'Peut gèrer les champs des types de page ?',
        ],
    ],
    'fields' => [
        'name'   => 'Champs',
        'option' => [
            'manage' => 'Peut gèrer les champs ?',
        ],
    ],
];
