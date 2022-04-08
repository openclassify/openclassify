<?php

return [
    'posts'      => [
        'name'   => 'Posts',
        'option' => [
            'read'    => 'Can access posts section.',
            'write'   => 'Can create and edit posts.',
            'delete'  => 'Can delete posts.',
            'preview' => 'Can preview posts.',
        ],
    ],
    'categories' => [
        'name'   => 'Categories',
        'option' => [
            'read'   => 'Can access categories section.',
            'write'  => 'Can create and edit categories.',
            'delete' => 'Can delete categories.',
        ],
    ],
    'types'      => [
        'name'   => 'Types',
        'option' => [
            'read'   => 'Can access types section.',
            'write'  => 'Can create and edit types.',
            'delete' => 'Can delete types.',
        ],
    ],
    'fields'     => [
        'name'   => 'Fields',
        'option' => [
            'manage' => 'Can manage custom fields.',
        ],
    ],
];
