<?php

return [
    'folders' => [
        'name'         => '资料夹',
        'instructions' => '指定可用于此字段的文件夹。保留空白以显示所有文件夹。',
        'warning'      => '现有文件夹权限优先于所选文件夹。',
    ],
    'min'     => [
        'label'        => '最少选择',
        'instructions' => '输入允许的选择的最小数量。',
    ],
    'max'     => [
        'label'        => '最大选择',
        'instructions' => '输入允许的最大选择数。',
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
