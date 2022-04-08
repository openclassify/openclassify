<?php

return [
    'mode'          => [
        'label'        => '模式',
        'instructions' => '要使用何种输入类型?',
        'option'       => [
            'dropdown' => '下拉',
            'radio'    => '单选按钮',
        ],
    ],
    'options'       => [
        'label'        => '选项',
        'instructions' => '在下方以 <strong>key: Value</strong> 或 <strong>Value</strong> 格式输入选项 . 每个选项独占一行.',
        'placeholder'  => 'key: Value',
    ],
    'default_value' => [
        'label'        => '预设值',
        'instructions' => '如有需要可在此输入预设值.',
    ],
];
