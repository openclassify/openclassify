<?php

return [
    'related'    => [
        'label'        => 'İlişkili Stream',
        'instructions' => 'Açılırlistede gösterilecek ilişkili stream girişlerini belirtin.',
    ],
    'mode'       => [
        'label'  => 'Giriş Modu',
        'option' => [
            'tags'       => 'Etiketler',
            'lookup'     => 'Bakış',
            'checkboxes' => 'Onay Kutuları',
        ],
    ],
    'min'        => [
        'label'        => 'Minimum seçim sayısı',
        'instructions' => 'İzin verilen minimum seçim sayısını belirtin.',
    ],
    'max'        => [
        'label'        => 'Maksimum seçim sayısı',
        'instructions' => 'İzin verilen maksimum seçim sayısını belirtin.',
    ],
    'title_name' => [
        'label'        => 'Başlık Alanı',
        'placeholder'  => 'İsim',
        'instructions' => 'Açılır menü / arama seçeneklerini görüntülemek için alanın <strong>slug</strong> değerini belirtin.<br> <strong>{entry.first_name} {entry.last_name}</strong><br> gibi sütun isimleri belirtebilirsiniz.',
    ],
];
