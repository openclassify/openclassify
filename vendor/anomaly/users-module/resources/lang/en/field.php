<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'roles' => 'Specify a short descriptive name for this role.',
        ],

    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'roles' => 'Briefly describe this role.',
        ],
    ],
    'first_name'       => [
        'name'         => 'First Name',
        'instructions' => 'Specify the user\'s real first name.',
    ],
    'last_name'        => [
        'name'         => 'Last Name',
        'instructions' => 'Specify the user\'s real last name.',
    ],
    'display_name'     => [
        'name'         => 'Display Name',
        'instructions' => 'Specify the user\'s publicly displayable name.',
    ],
    'username'         => [
        'name'         => 'Username',
        'instructions' => 'The username is used for uniquely identifying and displaying this user.',
    ],
    'email'            => [
        'name'         => 'Email',
        'instructions' => 'The email is used for logging in.',
    ],
    'password'         => [
        'name'         => 'Password',
        'instructions' => 'Specify the user\'s secure password.',
        'impersonate'  => 'Please confirm your current password to continue.',
    ],
    'confirm_password' => [
        'name' => 'Confirm Password',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'roles' => 'The slug is used in uniquely identifying this role.',
        ],
    ],
    'roles'            => [
        'name'         => 'Roles',
        'instructions' => 'Specify which roles the user belongs to.',
    ],
    'permissions'      => [
        'name' => 'Permissions',
    ],
    'last_activity_at' => [
        'name' => 'Last Activity',
    ],
    'activated'        => [
        'name'         => 'Activated',
        'label'        => 'Is this user activated?',
        'instructions' => 'The user will not be able to login unless activated.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => 'Is this user enabled?',
        'instructions' => 'The user will not be able to login or activate if disabled.',
    ],
    'activation_code'  => [
        'name' => 'Activation Code',
    ],
    'reset_code'       => [
        'name' => 'Reset Code',
    ],
    'remember_me'      => [
        'name' => 'Remember me',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'active'   => 'Active',
            'inactive' => 'Inactive',
            'disabled' => 'Disabled',
        ],
    ],
];
