<?php

return [
    'name'         => [
        'name'         => '名称',
        'instructions' => '字段名称为?'
    ],
    'slug'         => [
        'name'         => 'Slug',
        'instructions' => 'Slug会作为数据库中的字段名称.'
    ],
    'description'  => [
        'name'         => '描述',
        'instructions' => '请输入简短的描述.'
    ],
    'type'         => [
        'name'         => '字段类型',
        'instructions' => '要使用何种字段类型?'
    ],
    'placeholder'  => [
        'name'         => '替代文字',
        'instructions' => '若无输入内容则显示替代文字 (Placeholder).',
    ],
    'title_column' => [
        'name'         => '标题栏',
        'instructions' => '指定此字段的 Slug 作为标题使用?',
    ],
    'instructions' => [
        'name'         => '说明',
        'instructions' => '字段说明会在表单中显示以帮助用户.',
    ],
    'warning'      => [
        'name'         => '警告',
        'instructions' => '警告会令重要内容得到注意.',
    ],
    'translatable' => [
        'name'         => '可翻译',
        'instructions' => '条目是否支持 Stream 多语言?',
        'warning'      => '要令此 stream 正常运行则必须将翻译相应的字段.',
    ],
    'trashable'    => [
        'name'         => '可回收',
        'instructions' => '是否用回收方式来替代删除?',
    ],
    'sortable'     => [
        'name'         => '可排序',
        'instructions' => '在此 stream 中的条目可手动排序?',
    ],
    'searchable'   => [
        'name'         => '可搜索',
        'instructions' => '在此 stream 中的条目可手可搜索?',
    ],
    'config'       => [
        'name'         => '配置',
        'instructions' => '使用JSON指定可选的配置.',
    ],
];
