<?php

return [
    'title'            => [
        'name'         => 'Başlık',
        'instructions' => 'Bu sayfa için kısa bir açıklayıcı ad belirtin.',
    ],
    'slug'             => [
        'name'         => 'Özel Değer',
        'instructions' => [
            'types' => 'Özel değer, bu tür sayfalar için veritabanı tablosu oluşturulmasında kullanılır.',
            'pages' => 'Özel değer, sayfanın URL\'sini oluştururken kullanılır.
',
        ],
    ],
    'meta_title'       => [
        'name'         => 'Meta Başlığı',
        'instructions' => 'SEO başlığını belirtin.',
        'warning'      => 'Sayfa başlığı varsayılan olarak kullanılacaktır.',
    ],
    'meta_description' => [
        'name'         => 'Meta Açıklaması',
        'instructions' => 'SEO açıklamasını belirtin.
',
    ],
    'name'             => [
        'name'         => 'isim',
        'instructions' => 'Bu sayfa türü için kısa bir açıklayıcı ad belirtin.',
    ],
    'description'      => [
        'name'         => 'Açıklama',
        'instructions' => 'Bu sayfa türünü kısaca açıklayın.',
    ],
    'theme_layout'     => [
        'name'         => 'Tema düzeni',
        'instructions' => 'Kaydırılacak tema düzenini belirtin. <strong>sayfa düzeni</strong> ile.',
    ],
    'layout'           => [
        'name'         => 'Sayfa düzeni',
        'instructions' => 'Düzen, sayfanın içeriğini görüntülemek için kullanılır.',
    ],
    'allowed_roles'    => [
        'name'         => 'İzin verilen Roller',
        'instructions' => 'Hangi kullanıcı rollerinin bu sayfaya erişebileceğini belirtin.',
        'warning'      => 'Rol belirtilmezse, herkes bu sayfaya erişebilir.',
    ],
    'visible'          => [
        'name'         => 'Gözle görülür',
        'label'        => 'Bu sayfa navigasyonda gösterilsin mi?',
        'instructions' => 'Bu sayfayı sayfa tabanlı navigasyondan gizlemek için devre dışı bırak <strong>yapı</strong>.',
        'warning'      => 'Bu, web sitenizin nasıl oluşturulduğuna bağlı olarak etkili olabilir veya olmayabilir.',
    ],
    'exact'            => [
        'name'         => 'Tam URI',
        'label'        => 'Tam bir URI eşleşmesi ister misiniz?',
        'instructions' => 'Bu sayfanın URI\'sini izleyen özel parametrelere izin vermek için devre dışı bırakın.',
    ],
    'enabled'          => [
        'name'         => 'Etkin',
        'label'        => 'Bu sayfa etkin mi?',
        'instructions' => 'Devre dışı bırakılmışsa, kontrol panelinde güvenli bir önizleme bağlantısına hala erişebilirsiniz.',
        'warning'      => 'Bu sayfa görüntülenmeden önce etkinleştirilmiş olmalı <strong>al</strong>.',
    ],
    'home'             => [
        'name'         => 'Ana Sayfa',
        'label'        => 'Bu ana sayfa mı?',
        'instructions' => 'Ana sayfa, web siteniz için varsayılan açılış sayfasıdır.',
    ],
    'parent'           => [
        'name'         => 'Üst sayfa',
        'instructions' => 'Ebeveyn URI yapısı içinde düzenlemek için bir üst sayfa belirtin.',
    ],
    'handler'          => [
        'name'         => 'Handler',
        'instructions' => 'Sayfa handler, bir sayfanın tüm HTTP yanıtını oluşturmaktan sorumludur.',
    ],
    'content'          => [
        'name' => 'İçerik',
    ],
    'path'             => [
        'name' => 'Yolu',
    ],
    'type'             => [
        'name' => 'Tip',
    ],
];
