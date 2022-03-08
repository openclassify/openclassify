<?php

return [
    'folders' => [
        'name'         => 'Klasörler',
        'instructions' => 'Bu alan için hangi klasörlerin uygun olduğunu belirtin. Tüm klasörleri görüntülemek için boş bırakın.',
        'warning'      => 'Mevcut klasör izinleri seçili klasörlere göre önceliklidir.
',
    ],
    'min'     => [
        'label'        => 'Minimum Seçim',
        'instructions' => 'Minimum izin verilen seçim sayısını girin.',
    ],
    'max'     => [
        'label'        => 'Maksimum Seçim',
        'instructions' => 'İzin verilen maksimum seçim sayısını girin.',
    ],
    'mode'    => [
        'name'         => 'Giriş modu',
        'instructions' => 'Kullanıcılar dosya girdisini nasıl sağlamalıdır?',
        'option'       => [
            'default' => 'Dosyaları yükleyin ve / veya seçin.',
            'select'  => 'Sadece dosyaları seç.',
            'upload'  => 'Sadece dosya yükle.',
        ],
    ],
];
