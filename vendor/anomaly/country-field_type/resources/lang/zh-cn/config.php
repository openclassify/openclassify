<?php

return [
    'mode'          => [
        'label'        => '模式',
        'instructions' => '以何种输入方式显示?',
        'option'       => [
            'input'    => '文本输入框',
            'dropdown' => '下拉选择',
        ],
    ],
    'top_options'   => [
        'name'         => '优先选项',
        'instructions' => '输入 ISO Alpha-2 国家代码即可将对应国家选项移动到最上方. 每个国家代码独占一行.',
        'placeholder'  => "US\nCN\nHK",
    ],
    'default_value' => [
        'name'         => '默认值',
        'instructions' => '选择默认国家.',
    ],
];
