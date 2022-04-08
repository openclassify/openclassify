<?php

return [
    'users'    => [
        'name'   => 'Kullanıcılar',
        'option' => [
            'read'         => 'Kullanıcılar bölümüne erişebilir.',
            'write'        => 'Kullanıcılar oluşturabilir ve düzenleyebilir.',
            'write_admins' => 'Yöneticileri oluşturabilir ve düzenleyebilir.',
            'impersonate'  => 'Diğer kullanıcıları taklit edebilir.',
            'reset'        => 'Kullanıcıları sıfırlayabilir.',
            'delete'       => 'Kullanıcıları silebilir.',
        ],
    ],
    'roles'    => [
        'name'   => 'Roller',
        'option' => [
            'read'   => 'Roller bölümüne erişebilir.',
            'write'  => 'Rolleri oluşturabilir ve düzenleyebilir.',
            'delete' => 'Rolleri silebilir.',
        ],
    ],
    'fields'   => [
        'name'   => 'Alanlar',
        'option' => [
            'manage' => 'Özel alanları yönetebilir.',
        ],
    ],
    'settings' => [
        'name'   => 'Ayarlar',
        'option' => [
            'manage' => 'Eklenti ayarlarını yönetebilir.',
        ],
    ],
];
