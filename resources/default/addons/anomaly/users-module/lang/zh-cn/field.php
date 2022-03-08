<?php

return [
    'name'             => [
        'name'         => '名称',
        'instructions' => [
            'roles' => '为用户角色指定一个简短名称.',
        ],
    ],
    'description'      => [
        'name'         => '描述',
        'instructions' => [
            'roles' => '用户角色的简单描述.',
        ],
    ],
    'first_name'       => [
        'name'         => '名称',
        'instructions' => '指定用户的真实名称.',
    ],
    'last_name'        => [
        'name'         => '姓氏',
        'instructions' => '指定用户的真实姓氏.',
    ],
    'display_name'     => [
        'name'         => '显示名称',
        'instructions' => '指定用户对外公开的显示名称.',
    ],
    'username'         => [
        'name'         => '用户名',
        'instructions' => '独有的用户名用于标识和显示用户',
    ],
    'email'            => [
        'name'         => 'Email',
        'instructions' => '登入时使用的 Email 地址.',
    ],
    'password'         => [
        'name'             => '密码',
        'instructions'     => '指定用户的登入密码。',
    ],
    'confirm_password' => [
        'name' => '确认密码',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'roles' => '使用唯一的 Slug (缩略名) 作为用户角色的标识.',
        ],
    ],
    'roles'            => [
        'name'         => '角色',
        'instructions' => '指定用户所属的角色.',
    ],
    'permissions'      => [
        'name'  => '权限',
    ],
    'last_activity_at' => [
        'name' => '最后活动',
    ],
    'activated'        => [
        'name'         => '已激活',
        'label'        => '是否已激活？',
        'instructions' => '未激活的用户无法登入.',
    ],
    'enabled'          => [
        'name'         => '已启用',
        'label'        => '是否已启用？',
        'instructions' => '未启用的用户无法登入或激活.',
    ],
    'activation_code'  => [
        'name'         => '激活码',
    ],
    'reset_code'       => [
        'name' => '重设码',
    ],
    'remember_me'      => [
        'name' => '记住我',
    ],
    'status'           => [
        'name'   => '状态',
        'option' => [
            'active'   => '已激活',
            'inactive' => '未激活',
            'disabled' => '已禁用',
        ],
    ],
];
