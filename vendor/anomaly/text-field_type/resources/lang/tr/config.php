<?php

return [
    'type'          => [
        'label'        => 'Giriş Tipi',
        'instructions' => 'Gösterilecek giriş tipini belirtin.',
        'option'       => [
            'password' => 'Şifre',
            'email'    => 'E-posta',
            'text'     => 'Metin',
        ],
    ],
    'min'           => [
        'label'        => 'Minimum Uzunluk',
        'instructions' => 'İzin verilen minimum giriş uzunluğunu belirtin.',
    ],
    'max'           => [
        'label'        => 'Maksimum Uzunluk',
        'instructions' => 'İzin verilen maksimum giriş uzunluğunu belirtin.',
    ],
    'show_counter'  => [
        'label'        => 'Sayaç Göster',
        'instructions' => 'Giriş yapılırken kalan karakterler gösterilsin mi?',
    ],
    'suggested'     => [
        'label'        => 'Tavsiye Edilen Uzunluk',
        'instructions' => 'Tavsiye edilen giriş uzunluğunu belirtin.',
    ],
    'default_value' => [
        'label'        => 'Geçerli Değer',
        'instructions' => 'Geçerli değeri belirtin.',
    ],
];