<?php

return [
    'folders' => [
        'name'         => '資料夾',
        'instructions' => '指定可用於此字段的文件夾。保留空白以顯示所有文件夾。',
        'warning'      => '現有文件夾權限優先於所選文件夾。',
    ],
    'max'     => [
        'name'         => '最大上傳大小',
        'instructions' => '指定最大上傳大小（以 <strong>兆字節為單位）</strong>。',
        'warning'      => '如果未指定，則將使用文件夾max和server max代替。',
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
