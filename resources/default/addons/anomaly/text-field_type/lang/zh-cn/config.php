<?php

return [
    'type'          => [
        'label'        => '输入类型',
        'instructions' => '指定一个用于显示的输入类型。',
        'option'       => [
            'password' => '密码',
            'email'    => '电子邮箱',
            'text'     => '普通文本',
        ],
    ],
    'min'           => [
        'label'        => '最小长度',
        'instructions' => '指定允许输入的最小长度。',
    ],
    'max'           => [
        'label'        => '最大长度',
        'instructions' => '指定允许输入的最大长度。',
    ],
    'suggested'     => [
        'label'        => '建议长度',
        'instructions' => '指定建议的输入长度。',
    ],
    'default_value' => [
        'label'        => '默认值',
        'instructions' => '指定默认值。',
    ],
];
