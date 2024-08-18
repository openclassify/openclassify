<?php

return [
    [
        'tabs' => [
            'security'      => [
                'title'  => 'anomaly.module.users::tab.security',
                'fields' => [
                    'login',
                    'activation_mode',
                    'password_length',
                    'password_requirements',
                ],
            ],
            'notifications' => [
                'title'  => 'anomaly.module.users::tab.notifications',
                'fields' => [
                    'new_user_notification',
                    'pending_user_notification',
                ],
            ],
        ],
    ],
];
