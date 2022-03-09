<?php

return [
    'field'        => [
        'name'         => 'Alan',
        'label'        => 'Alan',
        'instructions' => 'Atanacak alanı seçin.',
    ],
    'label'        => [
        'name'         => 'Etiket',
        'instructions' => 'Etiket yalnızca formlar için kullanılacaktır. Boş bırakılırsa, alan adı kullanılacaktır.',
    ],
    'required'     => [
        'name'         => 'Zorunlu',
        'label'        => 'Bu alan zorunlu mu?',
        'instructions' => 'Gerekirse, bu alan her zaman bir değere sahip olmalıdır.',
    ],
    'unique'       => [
        'name'         => 'Benzersiz',
        'label'        => 'Bu alan benzersiz mi?',
        'instructions' => 'Benzersiz ise, bu alanın benzersiz bir değeri olması GEREKİR.',
    ],
    'searchable'   => [
        'name'         => 'Arama Yapılabilir',
        'label'        => 'Bu alan aranabilir mi?',
        'instructions' => 'Yalnızca aranabilir alanlar dizine eklenecek.',
    ],
    'placeholder'  => [
        'name'         => 'Yer tutucu',
        'instructions' => 'Desteklenirse, hiçbir giriş girilmediğinde yer tutucular girişte görüntülenir.',
    ],
    'translatable' => [
        'name'         => 'Çevrilebilir',
        'label'        => 'Bu alan çevrilebilir mi?',
        'instructions' => 'Çevirilebilirse bu alan tüm etkin yerlerde kullanılabilir.',
        'warning'      => [
            'column_type' => 'İlişkili alan türü çevrilmiş değerleri desteklemiyor.',
            'stream'      => 'İlişkili akış çevrilemez.',
        ],
    ],
    'instructions' => [
        'name'         => 'Talimatlar',
        'instructions' => 'Saha talimatları, kullanıcılara yardımcı olmak için formlarda gösterilecektir.',
    ],
    'warning'      => [
        'name'         => 'Uyarı',
        'instructions' => 'Uyarılar önemli bilgilere dikkat edilmesine yardımcı olur.',
    ],
];
