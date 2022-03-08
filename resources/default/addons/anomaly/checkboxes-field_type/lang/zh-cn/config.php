<?php

return [
    'mode'          => [
        'label'  => '输入模式',
        'option' => [
            'checkboxes' => '复选框',
            'tags'       => '标签',
        ]
    ],
    'options'       => [
        'label'        => '选项',
        'instructions' => '输入选项仅允许 <strong>key: Value</strong> 或 <strong>Value</strong> 格式. 每个选项占一行.',
        'placeholder'  => 'key: Value'
    ],
    'min'           => [
        'label'        => '至少选择数量',
        'instructions' => '输入至少需要选择的数量.'
    ],
    'max'           => [
        'label'        => '最多选择数量',
        'instructions' => '输入最多允许选择的数量.'
    ],
    'default_value' => [
        'label'        => '默认值',
        'instructions' => '输入默认的选择项目.'
    ]
];
