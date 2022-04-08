<?php

return [
    'name' => [
        'name' => '名稱',
    'instructions' => [
        'types' => '請為此文章型別指定一個簡短的名稱。',
    'categories' => '請為此類別指定一個簡短的名稱。',
    ],
    ],
    'title' => [
        'name' => '標題',
    'instructions' => '請輸入文章的標題。',
    ],
    'slug' => [
        'name' => '縮略名',
    'instructions' => [
        'types' => '此縮略是被用來產生此型別的資料表。',
    'categories' => '此縮略是用來建立類別的網址。',
    'posts' => '此縮略是用來建立文章的網址。',
    ],
    ],
    'description' => [
        'name' => '說明',
    'instructions' => [
        'types' => '請為此文章型別做簡述。',
    'categories' => '請簡述這個類別。',
    ],
    'warning' => '這取決於你的網站是如何構建的，這可能會或可能不會有效果。',
    ],
    'summary' => [
        'name' => '摘要',
    'instructions' => '此文章的簡短摘要。',
    ],
    'category' => [
        'name' => '分類',
    'instructions' => '請指定此文章的分類。',
    ],
    'meta_title' => [
        'name' => 'Meta 標題',
    'instructions' => '請輸入這文章的 SEO 標題。 如果沒有填寫，則預設為該文章的標題。',
    'warning' => '此文章標題預設會被使用。',
    ],
    'meta_description' => [
        'name' => 'Meta 說明',
    'instructions' => '請輸入這文章的 SEO 說明。',
    ],
    'theme_layout' => [
        'name' => '模板佈局',
    'instructions' => '這個 模板佈局(theme layout) 將會被用於 包裝(wrap) 文章的內容。',
    ],
    'layout' => [
        'name' => '佈局',
    'instructions' => '這個 佈局(layout) 將會被用來顯示頁面的內容。',
    ],
    'tags' => [
        'name' => '標籤',
    'instructions' => '請輸入經過組織的標籤，並以空白分隔。',
    ],
    'enabled' => [
        'name' => '啟用',
    'label' => '這個文章是否啟用？',
    'instructions' => '這篇文章只有在 啟用狀態下 並且 發表時間符合條件，才會顯示在網站上。',
    'warning' => '此文章可以公開查看之前，必須先被啟用。',
    ],
    'featured' => [
        'name' => '特色',
    'label' => '這是特色文章嗎？',
    'instructions' => '特色文章有別於一般的文章，將會有比較多的曝光機會。',
    'warning' => '這取決於你的網站是如何構建的，這可能會或可能不會有效果。',
    ],
    'publish_at' => [
        'name' => '發表於',
    'instructions' => '設定此文章要發表或公布的日期與時間。',
    'warning' => '如果時間設定在未來，此文章在那之前都不會被公布。',
    ],
    'author' => [
        'name' => '作者',
    'instructions' => '設定公開顯是的作者資訊。',
    ],
    'status' => [
        'name' => '狀態',
    'option' => [
        'live' => '上線',
    'draft' => '草稿',
    'scheduled' => '排程',
    ],
    ],
    'content' => [
        'name' => '內容',
    ],
];
