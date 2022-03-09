<?php

return [
    'login'                     => [
        'required'    => true,
        'placeholder' => false,
        'env'         => 'LOGIN',
        'bind'        => 'anomaly.module.users::config.login',
        'type'        => 'anomaly.field_type.select',
        'config'      => [
            'default_value' => 'email',
            'options'       => [
                'email'    => 'anomaly.module.users::setting.login.option.email',
                'username' => 'anomaly.module.users::setting.login.option.username',
            ],
        ],
    ],
    'activation_mode'           => [
        'required'    => true,
        'placeholder' => false,
        'env'         => 'ACTIVATION_MODE',
        'bind'        => 'anomaly.module.users::config.activation_mode',
        'type'        => 'anomaly.field_type.select',
        'config'      => [
            'default_value' => 'email',
            'options'       => [
                'email'     => 'anomaly.module.users::setting.activation_mode.option.email',
                'manual'    => 'anomaly.module.users::setting.activation_mode.option.manual',
                'automatic' => 'anomaly.module.users::setting.activation_mode.option.automatic',
            ],
        ],
    ],
    'password_length'           => [
        'required' => true,
        'env'      => 'PASSWORD_LENGTH',
        'bind'     => 'anomaly.module.users::password.minimum_length',
        'type'     => 'anomaly.field_type.integer',
        'config'   => [
            'default_value' => 8,
            'min'           => 4,
        ],
    ],
    'password_requirements'     => [
        'bind'   => 'anomaly.module.users::password.requirements',
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'default_value' => [
                '[a-z]',
                '[A-Z]',
            ],
            'options'       => [
                '[0-9]'        => 'anomaly.module.users::setting.password_requirements.option.[0-9]',
                '[a-z]'        => 'anomaly.module.users::setting.password_requirements.option.[a-z]',
                '[A-Z]'        => 'anomaly.module.users::setting.password_requirements.option.[A-Z]',
                '[!@#$%^&*()]' => 'anomaly.module.users::setting.password_requirements.option.[!@#$%^&*()]',
            ],
        ],
    ],
    'new_user_notification'     => [
        'type'   => 'anomaly.field_type.tags',
        'bind'   => 'anomaly.module.users::notifications.new_user',
        'config' => [
            'filter_tags' => FILTER_VALIDATE_EMAIL,
        ],
    ],
    'pending_user_notification' => [
        'type'   => 'anomaly.field_type.tags',
        'bind'   => 'anomaly.module.users::notifications.pending_user',
        'config' => [
            'filter_tags' => FILTER_VALIDATE_EMAIL,
        ],
    ],
];
