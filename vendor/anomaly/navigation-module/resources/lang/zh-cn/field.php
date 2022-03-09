<?php

return [
    'name'          => [
        'name'         => '名称',
        'instructions' => [
            'menus' => '为菜单指定一个简短的名称.',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'slug用于显示这个菜单.',
    ],
    'description'   => [
        'name'         => '描述',
        'instructions' => '对菜单的简短描述.',
    ],
    'target'        => [
        'name'         => '目标',
        'instructions' => '点击此链接后以何种方式打开?',
        'option'       => [
            'self'  => '在当前窗口打开.',
            'blank' => '在新窗口中打开.',
        ],
    ],
    'class'         => [
        'name'         => '样式',
        'instructions' => '指定附加的链接样式.',
    ],
    'allowed_roles' => [
        'name'         => '允许使用的角色',
        'instructions' => '仅某些指定的用户角色可以看到此链接.',
        'warning'      => '若不指定用户角色则所有人均可看到此链接.',
    ],
];
