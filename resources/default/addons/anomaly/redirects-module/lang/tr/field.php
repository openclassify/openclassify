<?php

return [
    'from'   => [
        'name'         => 'Gönderen',
        'label'        => 'Gönderenden yönlendir',
        'placeholder'  => [
            'redirects' => 'foo/bar/{var}',
            'domains'   => 'olddomain.com',
        ],
        'instructions' => [
            'redirects' => 'Yönlendirilecek tam bir yol veya desen belirtin. Örneğin<strong>foo/bar/{var}</strong> or <strong>foo/bar</strong> or <strong>http://{account}.old.com/{path}</strong>.',
            'domains'   => 'Yönlendirilecek etki alanını belirtin. Standart değilse herhangi bir ön ek ve bir bağlantı noktası ekleyin.',
        ],
        'warning'      => [
            'redirects' => 'Yerel ayarları gibi eklemeyin <strong>tr</strong>/foo/bar/{var}',
            'domains'   => 'Hiçbir yol bilgisi eklemeyin.',
        ],
    ],
    'to'     => [
        'name'         => 'İçin',
        'label'        => 'Yönlendir',
        'placeholder'  => [
            'redirects' => 'bar/{var}',
            'domains'   => 'newdomain.com',
        ],
        'instructions' => [
            'redirects' => 'Yönlendirilecek tam bir yol, model değiştirme veya URL belirtin. Örneğin<strong>bar/{var}</strong> or <strong>bar/baz</strong> or <strong>https://new.com/account/{account}/{path}</strong>.',
            'domains'   => 'Yönlendirilecek etki alanını belirtin. Standart değilse herhangi bir ön ek ve bir bağlantı noktası ekleyin.',
        ],
        'warning'      => [
            'domains' => 'Yapılandırılmış birincil etki alanını kullanmak için boş bırakın: <strong>' . config(
                    'streams::system.domain'
                ) . '</strong>',
        ],
    ],
    'status' => [
        'name'         => 'Durum',
        'instructions' => 'Bu nasıl bir yönlendirme?',
        'option'       => [
            '301' => '301 - Kalıcı Yönlendirme',
            '302' => '302 - Geçici Yönlendirme',
        ],
    ],
    'secure' => [
        'name'         => 'Güvenli',
        'label'        => 'Güvenli bir URL\'ye yönlendirilsin mi?',
        'instructions' => 'Yönlendirirken güvenli bir bağlantı kurmak ister misiniz?',
        'warning'      => 'İçinde bir protokol varsa, bu seçenek yoksayılır. <strong>Yönlendir</strong> değer.',
    ],
];
