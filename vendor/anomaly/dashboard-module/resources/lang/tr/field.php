<?php

return [
    'name'          => [
        'name'         => 'Adı',
        'instructions' => 'Bu Yönetim tablosu için kısa bir tanımlayıcı ad belirtin.',
    ],
    'title'         => [
        'name'         => 'Başlık',
        'instructions' => 'Bu widget için kısa bir açıklayıcı başlık belirtin.',
    ],
    'slug'          => [
        'name'         => 'Özel değer',
        'instructions' => 'Bilgi, Yönetim tablosu URL\'sinde kullanılır.',
    ],
    'description'   => [
        'name'         => 'Açıklama',
        'instructions' => [
            'dashboards' => 'Bu Yönetim tablosunu kısaca açıklayın.',
            'widgets'    => 'Bu widget\'ı kısaca açıklayın.',
        ],
    ],
    'layout'        => [
        'name'         => 'Düzen',
        'instructions' => 'Düzen, Yönetim tablosu widget\'larını nasıl düzenleyebileceğinizi belirler.',
        'option'       => [
            '24'      => 'Tek sütun',
            '12-12'   => 'İki eşit sütun',
            '16-8'    => 'İki sütun - sol ağırlıklı',
            '8-16'    => 'İki sütun - sağ ağırlıklı',
            '8-8-8'   => 'Üç eşit sütun',
            '6-12-6'  => 'Üç sütun - merkez ağırlıklı',
            '12-6-6'  => 'Üç sütun - sol ağırlıklı',
            '6-6-12'  => 'Üç sütun - sağ ağırlıklı',
            '6-6-6-6' => 'Dört eşit sütun',
        ],
    ],
    'dashboard'     => [
        'name'         => 'Yönetim Paneli',
        'instructions' => 'Bu widget\'ın hangi Yönetim tablosuna ait olduğunu seçin.',
    ],
    'extension'     => [
        'name' => 'Uzantı',
    ],
    'pinned'        => [
        'name'         => 'Sabitlemek',
        'label'        => 'Bu widget\'ı sabitle?',
        'instructions' => 'Sabitlenmiş widget\'lar tam genişliktedir ve Yönetim tablosunun üstüne itilir.',
    ],
    'allowed_roles' => [
        'name'         => 'İzin Verilen Roller',
        'instructions' => [
            'dashboards' => 'Bu kontrol paneline hangi kullanıcı rollerine erişebileceğini belirtin.',
            'widgets'    => 'Bu widget\'ı hangi kullanıcı rollerinin görebileceğini belirtin.',
        ],
        'warning'      => [
            'dashboards' => 'Hiçbir rol belirtilmezse, bu eklentiye erişimi olan herkes bu Yönetim tablosuna erişebilir.',
            'widgets'    => 'Hiçbir rol belirtilmezse, bu eklentiye erişimi olan herkes bu widget\'ı görebilir.',
        ],
    ],
];
