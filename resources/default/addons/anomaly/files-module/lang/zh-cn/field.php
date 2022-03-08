<?php

return [
    'name'          => [
        'name'         => '名称',
        'instructions' => [
            'disks'   => '为磁盘指定一个简短的名称.',
            'folders' => '为文件夹指定一个简短的名称.',
            'files'   => '为文件指定一个名称.',
        ],
    ],
    'title'         => [
        'name'         => '标题',
        'instructions' => '为文件指定一个简短的标题.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Slug 用于建立储存位置.',
    ],
    'size'          => [
        'name' => 'Size',
    ],
    'disk'          => [
        'name'         => '磁盘',
        'instructions' => '选择文件夹所属的磁盘.',
    ],
    'folder'        => [
        'name' => '文件夹',
    ],
    'adapter'       => [
        'name' => '适配器',
    ],
    'keywords'      => [
        'name'         => '关键字',
        'instructions' => '指定用于管理的关键字以便将文件分组.',
    ],
    'mime_type'     => [
        'name' => 'MIME类型',
    ],
    'preview'       => [
        'name' => '预览',
    ],
    'description'   => [
        'name'         => '描述',
        'instructions' => [
            'disks'  => '简要描述该磁盘.',
            'folder' => '简要描述该文件夹.',
            'files'  => '简要描述该文件.',
        ],
    ],
    'allowed_types' => [
        'name'         => '允许类型',
        'instructions' => '指定该文件夹允许的文件类型后缀.',
        'warning'      => '注意MIME类型的细微区别，例如 jpg 和 jpeg.',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
];
