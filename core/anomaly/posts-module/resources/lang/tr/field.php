<?php

return [
    'name'             => [
        'name'         => 'İsim',
        'instructions' => [
            'types'      => 'Bu yayın türü için kısa bir açıklayıcı ad belirtin.',
            'categories' => 'Bu kategori için kısa bir açıklayıcı ad belirtin.',
        ],
    ],
    'title'            => [
        'name'         => 'Başlık',
        'instructions' => 'Bu yayın için kısa bir açıklayıcı başlık belirtin.',
    ],
    'slug'             => [
        'name'         => 'Özel İsim',
        'instructions' => [
            'types'      => 'Özel isim, bu tür gönderiler için veritabanı tablosu oluşturulmasında kullanılır.',
            'categories' => 'Özel isim kategorinin URL\'sini oluştururken kullanılır.',
            'posts'      => 'Özel isim gönderinin URL\'sini oluştururken kullanılır.',
        ],
    ],
    'description'      => [
        'name'         => 'Açıklama',
        'instructions' => [
            'types'      => 'Yazı tipini kısaca açıklayın.',
            'categories' => 'Kategoriyi kısaca tanımlayın.',
        ],
        'warning'      => 'Bu, web sitenizin nasıl oluşturulduğuna bağlı olarak genel olarak gösterilebilir veya gösterilmeyebilir.',
    ],
    'summary'          => [
        'name'         => 'Özet',
        'instructions' => 'Bu gönderiyi tanıtmak için kısa bir özet yazın.',
    ],
    'category'         => [
        'name'         => 'Kategori',
        'instructions' => 'Bu gönderinin hangi kategoriye ait olduğunu seçin.',
    ],
    'meta_title'       => [
        'name'         => 'Meta Başlığı',
        'instructions' => 'SEO başlığını belirtin.',
        'warning'      => [
            'posts'      => 'Gönderi başlığı varsayılan olarak kullanılacaktır.',
            'types'      => 'Tip adı varsayılan olarak kullanılacaktır.',
            'categories' => 'Kategori adı varsayılan olarak kullanılacaktır.',
        ],
    ],
    'meta_description' => [
        'name'         => 'Meta Açıklaması',
        'instructions' => 'SEO açıklamasını belirtin.',
    ],
    'theme_layout'     => [
        'name'         => 'Tema Düzeni',
        'instructions' => 'Kaydırılacak tema düzenini belirtin. <strong>yazı düzeni</strong> ile.',
    ],
    'layout'           => [
        'name'         => 'Gönderi Düzeni',
        'instructions' => 'Düzen, gönderinin içeriğini görüntülemek için kullanılır.',
    ],
    'tags'             => [
        'name'         => 'Etiketler',
        'instructions' => 'Yayınınızı başkalarıyla birlikte gruplandırmanıza yardımcı olacak kuruluş etiketlerini belirtin.',
    ],
    'enabled'          => [
        'name'         => 'Etkin',
        'label'        => 'Bu yayın etkin mi?',
        'instructions' => 'Devre dışı bırakılmışsa, kontrol panelinde güvenli bir önizleme bağlantısına hala erişebilirsiniz.',
        'warning'      => 'Bu yayın görüntülenmeden önce etkinleştirilmelidir. <strong>alenen</strong>.',
    ],
    'featured'         => [
        'name'         => 'Featured',
        'label'        => 'Bu öne çıkan bir yazı mı?',
        'instructions' => 'Öne çıkan yayınlar, belirli yayınlara dikkat çekmek için kullanılabilir.',
        'warning'      => 'Bu, web sitenizin nasıl oluşturulduğuna bağlı olarak etkili olabilir veya olmayabilir.',
    ],
    'publish_at'       => [
        'name'         => 'Yayınlanma Tarihi / Saati',
        'instructions' => 'Bu yayının yayınlanma tarihini / saatini belirtin.',
        'warning'      => 'Geleceğe ayarlanmışsa, bu yayın o zamana kadar görünmez.',
    ],
    'author'           => [
        'name'         => 'Yazar',
        'instructions' => 'Bu yayının genel olarak görüntülenen yazarını belirtin.',
    ],
    'status'           => [
        'name'   => 'Durum',
        'option' => [
            'live'      => 'Canlı',
            'draft'     => 'Taslak',
            'scheduled' => 'Belirlenmiş',
        ],
    ],
    'content'          => [
        'name' => 'İçerik',
    ],
    'type'             => [
        'name' => 'Tip',
    ],
];
