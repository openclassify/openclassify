<?php

return [
    'login'           => [
        'label'        => '登入字段',
        'instructions' => '使用哪一个字段用于登入?',
        'option'       => [
            'email'    => 'Email',
            'username' => '用户名',
        ],
    ],
    'activation_mode' => [
        'label'        => '激活模式',
        'instructions' => '用户注册后如何激活?',
        'option'       => [
            'email'     => '向用户发送激活邮件.',
            'manual'    => '管理员手动激活用户.',
            'automatic' => '用户注册后自动激活.',
        ],
    ],
];
