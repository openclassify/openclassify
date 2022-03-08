<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => [
            'menus' => 'Specify a short descriptive name for this menu.',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug is used when displaying the menu.',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Briefly describe this navigation menu.',
    ],
    'target'        => [
        'name'         => 'Target',
        'instructions' => 'How does this link open when clicked?',
        'option'       => [
            'self'  => 'Open in the current window.',
            'blank' => 'Open in a new window.',
        ],
    ],
    'menu'          => [
        'name' => 'Menu',
    ],
    'type'          => [
        'name' => 'Type',
    ],
    'class'         => [
        'name'         => 'Class',
        'instructions' => 'Specify any additional link classes as instructed by your developer.',
    ],
    'allowed_roles' => [
        'name'         => 'Allowed Roles',
        'instructions' => 'Specify which user roles can see this link.',
        'warning'      => 'If no roles are specified then everyone can see this link.',
    ],
];
