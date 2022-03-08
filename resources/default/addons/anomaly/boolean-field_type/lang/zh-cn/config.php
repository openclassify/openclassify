<?php

return [
    'mode'          => [
        'label'        => '模式',
        'instructions' => '显示何种类型的输入方式?',
        'option'       => [
            'switch'   => 'Switch 切换开关',
            'checkbox' => 'Checkbox 勾选框',
            'dropdown' => 'Dropdown 下拉菜单',
            'radio'    => 'Radio Buttons 单选按钮',
        ],
    ],
    'label'         => [
        'label'        => '选项标签',
        'instructions' => '标签会显示在输入框旁.',
    ],
    'on_text'       => [
        'label'        => '"On" 文字',
        'instructions' => '此文字会用于切换开关的 "ON" 状态.',
        'placeholder'  => 'YES',
    ],
    'on_color'      => [
        'label'        => '"On" 颜色',
        'instructions' => '此颜色会用于切换开关的 "ON" 状态.',
        'option'       => [
            'green'  => '绿',
            'blue'   => '蓝',
            'orange' => '橙',
            'red'    => '红',
            'gray'   => '灰',
        ],
    ],
    'off_text'      => [
        'label'        => '"Off" 文字',
        'instructions' => '此文字会用于切换开关的 "OFF" 状态.',
        'placeholder'  => 'NO',
    ],
    'off_color'     => [
        'label'        => '"Off" 颜色',
        'instructions' => '此颜色会用于切换开关的 "OFF" 状态.',
        'option'       => [
            'green'  => '绿',
            'blue'   => '蓝',
            'orange' => '橙',
            'red'    => '红',
            'gray'   => '灰',
        ],
    ],
    'default_value' => [
        'label'        => '默认状态',
        'instructions' => '切换开关为?',
        'option'       => [
            'on'  => 'ON',
            'off' => 'OFF',
        ],
    ],
];
