<?php

return [
    'folders' => [
        'name'         => 'Klasörler',
        'instructions' => 'Bu alan için hangi klasörlerin mevcut olduğu belirtin. Bütün klasörleri göstermek için boş bırakın.',
        'warning'      => 'Varolan klasör izinleri, seçili klasörler üzerinde üstünlük gösterir.',
    ],
    'max'     => [
        'name'         => 'Maks Yükleme Boyutu',
        'instructions' => 'Maks yükleme boyutunu <strong>megabyte</strong> cinsinden belirtin.',
        'warning'      => 'Eğer belirtilmezse klasör maks ve sunucu maks değerleri kullanılır.',
    ],
    'mode'    => [
        'name'         => 'Giriş Modu',
        'instructions' => 'Kullanıcılar dosya girdisini nasıl sağlamalıdır?',
        'option'       => [
            'default' => 'Dosyaları yükleyin ve / veya seçin.',
            'select'  => 'Yalnızca dosyaları seçin.',
            'upload'  => 'Yalnızca dosya yükleyin.',
        ],
    ],
];
