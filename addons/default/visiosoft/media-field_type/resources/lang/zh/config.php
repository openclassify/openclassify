<?php

return [
    'folders' => [
        'name'         => '資料夾',
        'instructions' => '指定可用於此字段的文件夾。保留空白以顯示所有文件夾。',
        'warning'      => '現有文件夾權限優先於所選文件夾。',
    ],
    'min'     => [
        'label'        => '最少選擇',
        'instructions' => '輸入允許的選擇的最小數量。',
    ],
    'max'     => [
        'label'        => '最大選擇',
        'instructions' => '輸入允許的最大選擇數。',
    ],
    'mode'    => [
        'name'         => '輸入模式',
        'instructions' => '用戶應如何提供文件輸入？',
        'option'       => [
            'default' => '上傳和/或選擇文件。',
            'select'  => '僅選擇文件。',
            'upload'  => '僅上傳文件。',
        ],
    ],
];
