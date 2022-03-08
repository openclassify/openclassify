<?php

return [
    'login'                     => [
        'label'        => 'Login Field',
        'instructions' => 'Which field should be used for logging in?',
        'option'       => [
            'email'    => 'Email',
            'username' => 'Username',
        ],
    ],
    'activation_mode'           => [
        'label'        => 'Activation Mode',
        'instructions' => 'How should users be activated after they register?',
        'option'       => [
            'email'     => 'Send an activation email to the user.',
            'manual'    => 'Require an administrator to manually activate the user.',
            'automatic' => 'Automatically activate the user after they register.',
        ],
    ],
    'password_length'           => [
        'label'        => 'Password Length',
        'instructions' => 'Specify the minimum length for passwords.',
    ],
    'password_requirements'     => [
        'label'        => 'Password Requirements',
        'instructions' => 'Specify the character requirements for passwords.',
        'option'       => [
            '[0-9]'        => 'The password must contain at least one integer.',
            '[a-z]'        => 'The password must contain at least one lowercase letter.',
            '[A-Z]'        => 'The password must contain at least one uppercase letter.',
            '[!@#$%^&*()]' => 'The password must contain at least one special character.',
        ],
    ],
    'new_user_notification'     => [
        'name'         => 'New User Notification',
        'instructions' => 'Who should be notified of new users?',
    ],
    'pending_user_notification' => [
        'name'         => 'Pending User Notification',
        'instructions' => 'Who should be notified of users requiring activation?',
    ],
];
