<?php

return [
    'related'    => [
        'label'        => 'İlgili Akış',
        'instructions' => 'Açılır menüde görüntülenecek ilgili akış girişlerini belirtin.',
    ],
    'mode'       => [
        'label'  => 'Giriş Modu',
        'option' => [
            'tags'       => 'Etiket',
            'lookup'     => 'Arama',
            'checkboxes' => 'Onay Kutuları',
        ],
    ],
    'min'        => [
        'label'        => 'Minimum Seçim',
        'instructions' => 'Minimum izin verilen seçim sayı girin.',
    ],
    'max'        => [
        'label'        => 'Maksimum Seçim',
        'instructions' => 'İzin verilen maksimum seçim sayı girin.',
    ],
    'title_name' => [
        'label'        => 'Başlık Alanı',
        'placeholder'  => 'İsim',
        'instructions' => 'Açılır menü / arama seçeneklerini görüntülemek için alanın <strong>slug</strong> değerini belirtin.<br> <strong>{entry.first_name} {entry.last_name}</strong><br> gibi sütun isimleri belirtebilirsiniz.',
    ],
];
