<?php

return [
    'name'             => [
        'name'         => 'Adı',
        'instructions' => [
            'roles' => 'Bu rol için kısa bir açıklayıcı ad belirtin.',
        ],

    ],
    'description'      => [
        'name'         => 'Açıklama',
        'instructions' => [
            'roles' => 'Bu rolü kısaca açıklayınız.',
        ],
    ],
    'first_name'       => [
        'name'         => 'İsim',
        'instructions' => 'Kullanıcının gerçek ilk adını belirtin.',
    ],
    'last_name'        => [
        'name'         => 'Soyadı',
        'instructions' => 'Kullanıcının gerçek soyadını belirtin.',
    ],
    'display_name'     => [
        'name'         => 'Ekran adı',
        'instructions' => 'Kullanıcının genel olarak görülebilir adını belirtin.',
    ],
    'username'         => [
        'name'         => 'Kullanıcı adı',
        'instructions' => 'Kullanıcı adı, bu kullanıcıyı benzersiz bir şekilde tanımlamak ve görüntülemek için kullanılır.',
    ],
    'email'            => [
        'name'         => 'E-posta',
        'instructions' => 'E-posta, giriş yapmak için kullanılır.',
    ],
    'password'         => [
        'name'         => 'Parola',
        'instructions' => 'Kullanıcının güvenli şifresini belirtin.',
        'impersonate'  => 'Devam etmek için lütfen mevcut şifrenizi onaylayın.',
    ],
    'confirm_password' => [
        'name' => 'Şifreyi Onayla',
    ],
    'slug'             => [
        'name'         => 'Özel İsim',
        'instructions' => [
            'roles' => 'Özel isim bu rolü benzersiz olarak tanımlamak için kullanılır.',
        ],
    ],
    'roles'            => [
        'name'         => 'Roller',
        'instructions' => 'Kullanıcının hangi rollere ait olduğunu belirtin.',
    ],
    'permissions'      => [
        'name' => 'İzinler',
    ],
    'last_activity_at' => [
        'name' => 'Son Aktivite',
    ],
    'activated'        => [
        'name'         => 'Aktif',
        'label'        => 'Bu kullanıcı aktif mi?',
        'instructions' => 'Etkinleştirilmediği sürece kullanıcı giriş yapamaz.',
    ],
    'enabled'          => [
        'name'         => 'Etkin',
        'label'        => 'Bu kullanıcı etkin mi?',
        'instructions' => 'Kullanıcı, devre dışı bırakılırsa giriş yapamaz veya etkinleştiremez.',
    ],
    'activation_code'  => [
        'name' => 'Aktivasyon kodu',
    ],
    'reset_code'       => [
        'name' => 'Reset Kodu',
    ],
    'remember_me'      => [
        'name' => 'Beni Hatırla',
    ],
    'status'           => [
        'name'   => 'Durum',
        'option' => [
            'active'   => 'Aktif',
            'inactive' => 'Pasif',
            'disabled' => 'Engelli',
        ],
    ],
];
