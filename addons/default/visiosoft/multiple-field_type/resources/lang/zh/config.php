<?php

return [
    'related'    => [
        'label'        => '相关流',
        'instructions' => '指定要显示在下拉列表中的相关流条目。',
    ],
    'mode'       => [
        'label'  => '输入模式',
        'option' => [
            'tags'       => '标签',
            'lookup'     => '抬头',
            'checkboxes' => '选框',
        ],
    ],
    'min'        => [
        'label'        => '最少选择',
        'instructions' => '指定允许的选择的最小数量。',
    ],
    'max'        => [
        'label'        => '最大选择',
        'instructions' => '指定允许的最大选择数。',
    ],
    'title_name' => [
        'label'        => '标题栏',
        'placeholder'  => '名',
        'instructions' => '指定要显示的下拉列表/搜索选项的字段 <strong>条子</strong><br>您可以指定解析的游戏，比如 <strong>{entry.first_name} {entry.last_name}</strong><br>的相关数据流的标题栏将会被默认使用。',
    ],
];
