<?php

return [
    'related'    => [
        'label'        => '関連ストリーム',
        'instructions' => 'ドロップダウンに表示する関連ストリームエントリを指定します。',
    ],
    'mode'       => [
        'label'  => '入力モード',
        'option' => [
            'tags'       => 'タグ',
            'lookup'     => '見上げる',
            'checkboxes' => 'チェックボックス',
        ],
    ],
    'min'        => [
        'label'        => '最小選択',
        'instructions' => '許可される選択の最小数を指定します。',
    ],
    'max'        => [
        'label'        => '最大選択数',
        'instructions' => '許可される選択の最大数を指定します。',
    ],
    'title_name' => [
        'label'        => 'タイトルフィールド',
        'placeholder'  => 'ファーストネーム',
        'instructions' => 'ドロップダウン/検索オプションに表示するフィールドの <strong>スラッグ</strong> を指定します。<br>あなたのような解析可能なタイトルを指定することができます <strong>{entry.first_name} {entry.last_name}</strong><br>関連ストリームのタイトル欄は、デフォルトで使用されますが。',
    ],
];
