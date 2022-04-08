<?php

return [
    'name'         => [
        'name'         => 'İsim',
        'instructions' => 'Alan adı nedir?',
    ],
    'slug'         => [
        'name'         => 'Slug',
        'instructions' => 'Diğer şeylerin yanı sıra, veritabanı sütun adı için kullanılır.',
    ],
    'description'  => [
        'name'         => 'Açıklama',
        'instructions' => 'Kısa bir açıklama girin.',
    ],
    'type'         => [
        'name'         => 'Alan türü',
        'instructions' => 'Bu alan için hangi alan türünü kullanmak istiyorsunuz?',
        'warning'      => 'Bu değerin değiştirilmesi hemen sayfanın yeniden yüklenmesine neden olacaktır.',
    ],
    'placeholder'  => [
        'name'         => 'Yer tutucu',
        'instructions' => 'Desteklenirse, hiçbir giriş girilmediğinde yer tutucular girişte görüntülenir.',
    ],
    'title_column' => [
        'name'         => 'Başlık Sütunu',
        'instructions' => 'Başlık olarak görev yapan alan alanını belirtin?',
    ],
    'instructions' => [
        'name'         => 'Talimatlar',
        'instructions' => 'Saha talimatları, kullanıcılara yardımcı olmak için formlarda gösterilecektir.',
    ],
    'warning'      => [
        'name'         => 'Uyarı',
        'instructions' => 'Uyarılar önemli bilgilere dikkat edilmesine yardımcı olur.',
    ],
    'translatable' => [
        'name'         => 'Çevrilebilir',
        'instructions' => 'Bu akıştaki girişler çok dilli mi?',
        'warning'      => 'Aktarılabilir alanların düzgün çalışması için akışın çevrilebilir olması gerekir.',
    ],
    'trashable'    => [
        'name'         => 'Trashable',
        'instructions' => 'Girişleri silmek yerine çöp kutusuna atmak ister misiniz?',
    ],
    'versionable'  => [
        'name'         => 'Geçerli Sürüm',
        'instructions' => 'Her kayıt yaptıklarında girişlerdeki değişiklikleri izlemek ister misiniz?',
    ],
    'sortable'     => [
        'name'         => 'Sıralanabilir',
        'instructions' => 'Bu akıştaki girişler manuel olarak mı sıralanabilir?',
    ],
    'searchable'   => [
        'name'         => 'Arama Yapılabilir',
        'instructions' => 'Bu akıştaki girişler aranabilir mi?',
    ],
    'config'       => [
        'name'         => 'Yapılandırma',
        'instructions' => 'JSON kullanarak isteğe bağlı herhangi bir yapılandırmayı belirtin.',
    ],
];
