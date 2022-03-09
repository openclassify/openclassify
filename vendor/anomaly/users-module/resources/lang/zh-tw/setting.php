<?php

return [
    'login'           => [
        'label'        => '登入欄位',
        'instructions' => '請指定用來登入的欄位。',
        'option'       => [
            'email'    => '電子郵件',
            'username' => '用戶名稱 username',
        ],
    ],
    'activation_mode' => [
        'label'        => '啟動模式',
        'instructions' => '用戶在註冊後應該要如何被啟動呢？',
        'option'       => [
            'email'     => '寄出啟動郵件給該用戶。',
            'manual'    => '需要管理員手動來設定並啟動用戶。',
            'automatic' => '用戶註冊後系統自動啟動該用戶。',
        ],
    ],
];
