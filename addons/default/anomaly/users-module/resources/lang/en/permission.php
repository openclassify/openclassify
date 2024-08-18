<?php

return [
    'users'    => [
        'name'   => 'Users',
        'option' => [
            'read'         => 'Can access users section.',
            'write'        => 'Can create and edit users.',
            'write_admins' => 'Can create and edit admins.',
            'impersonate'  => 'Can impersonate other users.',
            'reset'        => 'Can reset users.',
            'delete'       => 'Can delete users.',
            'manage_permissions' => 'Can manage a user\'s permissions.',
        ],
    ],
    'roles'    => [
        'name'   => 'Roles',
        'option' => [
            'read'   => 'Can access roles section.',
            'write'  => 'Can create and edit roles.',
            'delete' => 'Can delete roles.',
        ],
    ],
    'fields'   => [
        'name'   => 'Fields',
        'option' => [
            'manage' => 'Can manage custom fields.',
        ],
    ],
    'settings' => [
        'name'   => 'Settings',
        'option' => [
            'manage' => 'Can manage addon settings.',
        ],
    ],
];
