<?php

return [
    'name'             => [
        'name'         => '名稱',
        'instructions' => [
            'roles' => '請為這個角色指定一個簡短的名稱。',
        ],
    ],
    'description'      => [
        'name'         => '簡述',
        'instructions' => [
            'roles' => '請簡要的描述這個角色。',
        ],
    ],
    'first_name'       => [
        'name'         => '大名',
        'instructions' => '請指定用戶的大名。',
    ],
    'last_name'        => [
        'name'         => '姓氏',
        'instructions' => '請指定用戶的姓氏。',
    ],
    'display_name'     => [
        'name'         => '顯示名稱',
        'instructions' => '請指定用戶對外公開的顯示名稱。',
    ],
    'username'         => [
        'name'         => '用戶名稱',
        'instructions' => '用戶名稱 username 會作為用戶在系統中的唯一識別。',
    ],
    'email'            => [
        'name'         => '電子郵件',
        'instructions' => '登入時將使用此電子郵件。',
    ],
    'password'         => [
        'name'         => '密碼',
        'instructions' => '請指定用戶的密碼。',
    ],
    'confirm_password' => [
        'name' => '確認密碼',
    ],
    'slug'             => [
        'name'         => '縮略',
        'instructions' => [
            'roles' => '此縮略名 slug 將作為這個角色獨一無二的識別名稱。',
        ],
    ],
    'roles'            => [
        'name'         => '角色',
        'instructions' => '請指定此用戶所屬的角色。',
    ],
    'permissions'      => [
        'name' => '權限',
    ],
    'last_activity_at' => [
        'name' => '上次活動時間',
    ],
    'activated'        => [
        'name'         => '已啟動(開通)',
        'label'        => '這個用戶啟動(開通)了嗎？',
        'instructions' => '這個用戶必須啟動(開通)後才能登入。',
    ],
    'enabled'          => [
        'name'         => '已啟用',
        'label'        => '這個用戶啟用了嗎？',
        'instructions' => '這個用戶如果尚未啟用，則無法登入或是開通帳號。',
    ],
    'activation_code'  => [
        'name' => '啟動代碼',
    ],
    'reset_code'       => [
        'name' => '重設代碼',
    ],
    'remember_me'      => [
        'name' => '記住我',
    ],
    'status'           => [
        'name'   => '狀態',
        'option' => [
            'active'   => '使用中',
            'inactive' => '非使用中',
            'disabled' => '禁用中',
        ],
    ],
];
