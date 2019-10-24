<?php

return [
    'login'                     => [
        'label'        => 'Giriş Alanı',
        'instructions' => 'Giriş yapmak için hangi alan kullanılmalıdır?',
        'option'       => [
            'email'    => 'E-posta',
            'username' => 'Kullanıcı adı',
        ],
    ],
    'activation_mode'           => [
        'label'        => 'Aktivasyon Modu',
        'instructions' => 'Kullanıcılar kayıt olduktan sonra nasıl etkinleştirilmelidir?',
        'option'       => [
            'email'     => 'Kullanıcıya bir aktivasyon e-postası gönder.',
            'manual'    => 'Kullanıcıyı manuel olarak etkinleştirmek için yönetici isteyin.',
            'automatic' => 'Kaydolduktan sonra kullanıcıyı otomatik olarak etkinleştir.',
        ],
    ],
    'password_length'           => [
        'label'        => 'Şifre uzunluğu',
        'instructions' => 'Şifreler için minimum uzunluğu belirtin.',
    ],
    'password_requirements'     => [
        'label'        => 'Parola gereksinimleri',
        'instructions' => 'Şifreler için karakter gereksinimlerini belirtin.',
        'option'       => [
            '[0-9]'        => 'Şifre en az bir tam sayı içermelidir.',
            '[a-z]'        => 'Şifre en az bir küçük harf içermelidir.',
            '[A-Z]'        => 'Şifre en az bir büyük harf içermelidir.',
            '[!@#$%^&*()]' => 'Şifre en az bir özel karakter içermelidir.',
        ],
    ],
    'new_user_notification'     => [
        'name'         => 'Yeni Kullanıcı Bildirimi',
        'instructions' => 'Kimler yeni kullanıcılardan haberdar edilmelidir?',
    ],
    'pending_user_notification' => [
        'name'         => 'Bekleyen Kullanıcı Bildirimi',
        'instructions' => 'Aktivasyon gerektiren kullanıcılara kimler bilgilendirilmelidir?',
    ],
];
