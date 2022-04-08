<?php

return [
    'field'        => [
        'name'         => '字段',
        'label'        => '字段',
        'instructions' => '选择一个字段.'
    ],
    'label'        => [
        'name'         => '标签',
        'instructions' => '标签(Label)仅用于表单中，若留空则会使用字段名称.'
    ],
    'required'     => [
        'name'         => '必填',
        'label'        => '字段为必填?',
        'instructions' => '若为必填则此字段不能为空.'
    ],
    'unique'       => [
        'name'         => '唯一',
        'label'        => '为唯一字段?',
        'instructions' => '若为唯一则此字段将不允许有相同的值存在.'
    ],
    'placeholder'  => [
        'name'         => '替代文字',
        'instructions' => '若无输入则显示替代文字(placeholders).'
    ],
    'translatable' => [
        'name'         => '可翻译',
        'label'        => '为可翻译字段?',
        'instructions' => '若为可翻译字段则会在所有已启用的语言中可用.',
        'warning'      => '此关联字段类型不支持翻译的值.'
    ],
    'instructions' => [
        'name'         => '说明',
        'instructions' => '字段说明将会在表单中显示.'
    ],
    'warning'      => [
        'name'         => '警告',
        'instructions' => '警告将作为重要信息的提醒.'
    ]
];
