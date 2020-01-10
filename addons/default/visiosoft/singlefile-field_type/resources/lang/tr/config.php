<?php

return [
    'folders' => [
        'name'         => 'Klasörler',
        'instructions' => 'Bu alan için hangi klasörlerin mevcut olduğu belirtin. Bütün klasörleri göstermek için boş bırakın.',
        'warning'      => 'Varolan klasör izinleri, seçili klasörler üzerinde üstünlük gösterir',
    ],
    'max'     => [
        'name'         => 'Maks Yükleme Boyutu',
        'instructions' => 'Maks yükleme boyutunu <strong>megabyte</strong> cinsinden belirtin.',
        'warning'      => 'Eğer belirtilmezse klasör maks ve sunucu maks değerleri kullanılır.',
    ],
    'mode'    => [
        'name'         => 'Input Mode',
        'instructions' => 'How should users provide file input?',
        'option'       => [
            'default' => 'Upload and/or select files.',
            'select'  => 'Select files only.',
            'upload'  => 'Upload files only.',
        ],
    ],
];
