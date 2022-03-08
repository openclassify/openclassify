<?php

return [
    'title' => [
        'name' => '標題',
    'instructions' => '請問這頁面的標題是什麼？',
    ],
    'slug' => [
        'name' => '縮略(slug)',
    'instructions' => [
        'types' => '此縮略將用來為此資料欄位產生資料庫中的資料表。',
    'pages' => '此縮略被用來建立頁面的網址。',
    ],
    ],
    'meta_title' => [
        'name' => 'Meta 標題',
    'instructions' => '請輸入這頁面的 SEO 標題。 如果沒有填寫，則預設為該頁面的標題。',
    'warning' => '預設將會使用此頁面的標題。',
    ],
    'meta_description' => [
        'name' => 'Meta 說明',
    'instructions' => '請輸入這頁面的 SEO 說明。',
    ],
    'name' => [
        'name' => '名稱',
    'instructions' => '請問這頁面的 型別(page type) 名稱是什麼？',
    ],
    'description' => [
        'name' => '說明',
    'instructions' => '請簡述這個 頁面型別(page type)。',
    ],
    'theme_layout' => [
        'name' => '模板佈局',
    'instructions' => '這個 模板佈局(theme layout) 將會被用於 包裝(wrap) 頁面的內容。',
    ],
    'layout' => [
        'name' => '佈局',
    'instructions' => '這個 佈局(layout) 將會被用來顯示頁面的內容。',
    ],
    'allowed_roles' => [
        'name' => '允許操作的角色',
    'instructions' => '什麼使用者角色可以瀏覽此頁面？',
    'warning' => '如果沒有指定角色，那麼所有人都可以存取此頁面。',
    ],
    'visible' => [
        'name' => '顯示',
    'label' => '可否在導覽列中顯示？',
    'instructions' => '設定禁用將在程式生成的導覽列中隱藏。',
    'warning' => '這取決於你的網站是如何構建的，這可能會或可能不會有效果。',
    ],
    'exact' => [
        'name' => '相同的 URI',
    'label' => 'URI 是否必須完全相同？',
    'instructions' => '如果設定關閉，代表允許 有其他參數附加時 也可以到達此頁面。',
    ],
    'enabled' => [
        'name' => '啟用',
    'label' => '啟用這個頁面嗎？',
    'instructions' => '如果設定禁用，這個頁面將會有個安全網址，讓您仍可與其他人分享。',
    'warning' => '此頁面需要啟用，才能對外公布。',
    ],
    'home' => [
        'name' => '首頁',
    'label' => '請問這是網站首頁嗎？',
    'instructions' => '首頁是網站的預設到達頁面。',
    ],
    'parent' => [
        'name' => '父頁面',
    ],
    'handler' => [
        'name' => '頁面處理器',
    'instructions' => '頁面處理器將負責建立頁面的 HTTP 回應。',
    ],
    'content' => [
        'name' => '內容',
    ],
    'path' => [
        'name' => '路徑',
    ],
];
