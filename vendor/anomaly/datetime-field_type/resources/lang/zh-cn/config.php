<?php

return [
    'mode'        => [
        'label'        => '输入模式',
        'instructions' => '显示日期, 时间或是两者皆有的输入框?',
        'datetime'     => '日期 + 时间',
        'date'         => '日期',
        'time'         => '时间',
    ],
    'date_format' => [
        'label'        => '日期格式',
        'instructions' => '选择输入日期的格式.',
    ],
    'time_format' => [
        'label'        => '时间格式',
        'instructions' => '选择输入时间的格式.',
    ],
    'timezone'    => [
        'label'        => '时区',
        'instructions' => '选择时区.',
        'placeholder'  => '默认时区',
    ],
    'step'        => [
        'label'        => '选择分钟间隔步数',
        'instructions' => '选择输入分钟时每次点击的分钟间隔.',
    ],
    'year_range'  => [
        'label'        => '年范围',
        'placeholder'  => '1900:+100',
        'instructions' => '使用 <strong>min:max</strong> 格式限制年的选择范围.',
    ],
    'min'         => [
        'label'        => '最早日期',
        'instructions' => '输入向前偏移(-)的天数以限制最早日期的选择范围.',
        'placeholder'  => '-30',
    ],
    'max'         => [
        'label'        => '最迟日期',
        'instructions' => '输入向后偏移的(+)天数以限制最迟日期的选择范围.',
        'placeholder'  => '45',
    ],
];
