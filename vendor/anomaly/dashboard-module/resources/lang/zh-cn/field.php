<?php

return [
    'name'          => [
        'name'         => '名称',
        'instructions' => '为控制台指定一个简短的名称.',
    ],
    'title'         => [
        'name'         => '标题',
        'instructions' => '为挂件指定一个简短的描述标题.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Slug 用于控制台的 URL.',
    ],
    'description'   => [
        'name'         => '描述',
        'instructions' => [
            'dashboards' => '简要描述此控制台.',
            'widgets'    => '简要描述此挂件.',
        ],
    ],
    'layout'        => [
        'name'         => '排版',
        'instructions' => '排版决定如何组织和展示控制台及挂件.',
        'option'       => [
            '24'      => '单栏',
            '12-12'   => '两个相等的栏',
            '16-8'    => '两栏 - 左栏为主',
            '8-16'    => '两栏 - 右栏为主',
            '8-8-8'   => '三个相等的栏',
            '6-12-6'  => '三栏 - 中栏为主',
            '12-6-6'  => '三栏 - 左栏为主',
            '6-6-12'  => '三栏 - 右栏为主',
            '6-6-6-6' => '四个相等的栏',
        ],
    ],
    'dashboard'     => [
        'name'         => '控制台',
        'instructions' => '选择挂件所属的控制台.',
    ],
    'extension'     => [
        'name' => '扩展',
    ],
    'pinned'        => [
        'name'         => '固定',
        'label'        => '固定此挂件?',
        'instructions' => '固定全大的挂件并置于控制台顶层.',
    ],
    'allowed_roles' => [
        'name'         => '允许角色',
        'instructions' => [
            'dashboards' => '指定允许访问此控制台的用户角色.',
            'widgets'    => '指定允许访问此挂件的用户角色.',
        ],
        'warning'      => [
            'dashboards' => '若不指定角色则所有人均可访问此控制台.',
            'widgets'    => '若不指定角色则所有人均可访问此挂件.',
        ],
    ],
];
