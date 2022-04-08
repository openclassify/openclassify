<?php

return [
    'field'        => [
        'name'         => '欄位',
        'label'        => '欄位',
        'instructions' => '請指定一個欄位。'
    ],
    'label'        => [
        'name'         => '標籤',
        'instructions' => '標籤(Label) 只會使用在 表單(Form) 當中，如果沒有填寫，欄位名稱會自動被採用。'
    ],
    'required'     => [
        'name'         => '必填',
        'label'        => '這是個必填欄位嗎？',
        'instructions' => '如果是必填，這個欄位就必須有變數值。'
    ],
    'unique'       => [
        'name'         => '唯一',
        'label'        => '這個欄位的變數值是唯一的嗎？',
        'instructions' => '如果是唯一，這個欄位的變數值就不能是相同的。'
    ],
    'placeholder'  => [
        'name'         => '替代文字',
        'instructions' => '如果程式支援，替代文字(placeholders) 將會在 input 沒有輸入時顯示。'
    ],
    'translatable' => [
        'name'         => '多語言',
        'label'        => '這個欄位使用多語言嗎？',
        'instructions' => '如果是，那麼就將開啟所有啟用中的語言欄位。'
    ],
    'instructions' => [
        'name'         => '說明',
        'instructions' => '欄位說明將會出現在表單當中。'
    ],
    'warning'      => [
        'name'         => '警告',
        'instructions' => '警告將作為重要資訊的提醒。'
    ]
];
