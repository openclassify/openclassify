<?php

return [
    'mode'          => [
        'label'        => 'Mod',
        'instructions' => 'Ne tür bir giriş göstermek istiyorsunuz?',
        'option'       => [
            'switch'   => 'Anahtar',
            'checkbox' => 'Kutucuk',
            'dropdown' => 'Açılır Liste',
            'radio'    => 'Tekli Seçim',
        ],
    ],
    'label'         => [
        'label'        => 'Seçenek Etiketi',
        'instructions' => 'Bu etiket girişin tam sağında gösterilir.',
    ],
    'on_text'       => [
        'label'        => '&quot;Açık&quot; Metni',
        'instructions' => 'Bu metin anahtarın &quot;açık&quot; konumu için kullanılacaktır.',
        'placeholder'  => 'EVET',
    ],
    'on_color'      => [
        'label'        => '&quot;Açık&quot; Rengi',
        'instructions' => 'Bu renk anahtarın &quot;açık&quot; konumu için kullanılacaktır.',
        'option'       => [
            'green'  => 'Yeşil',
            'blue'   => 'Mavi',
            'orange' => 'Turuncu',
            'red'    => 'Kırmızı',
            'gray'   => 'Gri',
        ],
    ],
    'off_text'      => [
        'label'        => '&quot;Kapalı&quot; Metni',
        'instructions' => 'Bu metin anahtarın &quot;kapalı&quot; konumu için kullanılacaktır.',
        'placeholder'  => 'HAYIR',
    ],
    'off_color'     => [
        'label'        => '&quot;Kapalı&quot; Rengi',
        'instructions' => 'Bu renk anahtarın &quot;kapalı&quot; konumu için kullanılacaktır.',
        'option'       => [
            'green'  => 'Yeşil',
            'blue'   => 'Mavi',
            'orange' => 'Turuncu',
            'red'    => 'Kırmızı',
            'gray'   => 'Gri',
        ],
    ],
    'default_value' => [
        'label'        => 'Geçerli Konum',
        'instructions' => 'Anahtarın geçerli konumu nedir?',
        'option'       => [
            'on'  => 'AÇIK',
            'off' => 'KAPALI',
        ],
    ],
];