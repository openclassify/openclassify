<?php

return [
    'folders' => [
        'name'         => '资料夹',
        'instructions' => '指定可用于此字段的文件夹。保留空白以显示所有文件夹。',
        'warning'      => '现有文件夹权限优先于所选文件夹。',
    ],
    'max'     => [
        'name'         => '最大上传大小',
        'instructions' => '指定最大上传大小（以 <strong>兆字节为单位）</strong>。',
        'warning'      => '如果未指定，则将使用文件夹max和server max代替。',
    ],
    'mode'    => [
        'name'         => '输入模式',
        'instructions' => '用户应如何提供文件输入？',
        'option'       => [
            'default' => '上传和/或选择文件。',
            'select'  => '仅选择文件。',
            'upload'  => '仅上传文件。',
        ],
    ],
];
