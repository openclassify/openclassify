<?php

return [
    'min'           => [
        'label'        => '最少标签数量',
        'instructions' => '请输入需要的最少选项数量。',
    ],
    'max'           => [
        'label'        => '最多标签数量',
        'instructions' => '请输入需要的最少选项数量。',
    ],
    'filter'        => [
        'label'        => '过滤器',
        'instructions' => '指定标签过滤器，你也可以输入正则匹配表达式，比如  <strong>https://*.com</strong>。',
    ],
    'options'       => [
        'label'        => '可选的选项',
        'instructions' => '输入可选的选项，每个选项占一行。',
        'placeholder'  => "foo\nbar\nbaz",
    ],
    'source'        => [
        'label'        => '来源',
        'instructions' => '指定选项的来源 URL。',
    ],
    'free_input'    => [
        'label'        => '自由输入',
        'instructions' => '是否允许输入不在可选选项中的其他数据？',
    ],
    'default_value' => [
        'label'        => '默认值',
        'instructions' => '请输入默认值。',
    ],
];
