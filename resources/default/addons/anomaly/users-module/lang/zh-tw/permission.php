<?php

return [
    'users'    => [
        'name'   => '用戶',
        'option' => [
            'read'   => '可讀取用戶資料。',
            'write'  => '可建立與編輯用戶資料。',
            'delete' => '可刪除用戶資料。',
        ],
    ],
    'roles'    => [
        'name'   => '角色',
        'option' => [
            'read'   => '可讀取角色資料。',
            'write'  => '可建立與編輯角色資料。',
            'delete' => '可刪除角色資料。',
        ],
    ],
    'fields'   => [
        'name'   => '欄位',
        'option' => [
            'manage' => '可管理自訂欄位。',
        ],
    ],
    'settings' => [
        'name'   => '設定',
        'option' => [
            'manage' => '可管理附加元件 addon 設定。',
        ],
    ],
];
