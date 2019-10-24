<?php

return [
    'name'          => [
        'name'         => 'Adı',
        'instructions' => 'Bu gösterge tablosu için kısa bir açıklayıcı ad belirtin.',
    ],
    'title'         => [
        'name'         => 'Başlık',
        'instructions' => 'Bu widget için kısa bir açıklayıcı başlık belirtin.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Bilgi panosu URL’sinde özel isim kullanılır.',
    ],
    'description'   => [
        'name'         => 'Açıklama',
        'instructions' => [
            'dashboards' => 'Bu gösterge tablosunu kısaca açıklayınız.',
            'widgets'    => 'Bu widget\'ı kısaca açıklayın.',
        ],
    ],
    'layout'        => [
        'name'         => 'Layout',
        'instructions' => 'Düzen, pano widget\'larını nasıl düzenleyebileceğinizi belirler.',
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
        'name'         => 'kontrol paneli',
        'instructions' => 'Bu widget\'in hangi panele ait olduğunu seçin.',
    ],
    'extension'     => [
        'name' => 'Uzantı',
    ],
    'pinned'        => [
        'name'         => 'Sabitle',
        'label'        => 'Bu widget\'ı sabitle?',
        'instructions' => 'Sabitlenmiş widget\'ler tam genişliktedir ve gösterge panelinin üstüne itilir.',
    ],
    'allowed_roles' => [
        'name'         => 'İzin Verilen Roller',
        'instructions' => [
            'dashboards' => 'Hangi kullanıcı rollerinin bu gösterge panosuna erişebileceğini belirtin.',
            'widgets'    => 'Hangi widget\'ların bu widget\'ı görebileceğini belirtin.',
        ],
        'warning'      => [
            'dashboards' => 'Rol belirtilmemişse, bu eklentiye erişimi olan herkes bu gösterge panosuna erişebilir.',
            'widgets'    => 'Rol belirtilmemişse, bu eklentiye erişimi olan herkes bu widget\'ı görebilir.',
        ],
    ],
];
