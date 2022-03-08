<?php

return [
    'name'             => [
        'name'         => 'الأسم',
        'instructions' => [
            'roles' => 'حدد اسم مختصر يصف هذا الدور.',
        ],
    ],
    'description'      => [
        'name'         => 'الوصف',
        'instructions' => [
            'roles' => 'صف هذا الدور بشكل مخنصر.',
        ],
    ],
    'first_name'       => [
        'name'         => 'الأسم الأول',
        'instructions' => 'حدد اسم المستخدم الأول.',
    ],
    'last_name'        => [
        'name'         => 'اللقب',
        'instructions' => 'حدد اسم المستخدم الثاني (الكنية).',
    ],
    'display_name'     => [
        'name'         => 'الأسم المعروض',
        'instructions' => 'حدد الأسم الذي يتم عرضه للعامة.',
    ],
    'username'         => [
        'name'         => 'اسم المستخدم',
        'instructions' => 'اسم المستخدم يستخدم للتعريف بشكل فريد بالمستخدم وعرض أسمه.',
    ],
    'email'            => [
        'name'         => 'البريد الالكتروني',
        'instructions' => 'البريد الالكترني يستخدم لتسجيل الدخول.',
    ],
    'password'         => [
        'name'         => 'كلمة المرور',
        'instructions' => 'تحديد كلمة المرور المحمية.',
    ],
    'confirm_password' => [
        'name' => 'تأكيد كلمة المرور',
    ],
    'slug'             => [
        'name'         => 'المعرف',
        'instructions' => [
            'roles' => 'المعرف يستخدم للتعريف بشكل فريد عن هذا الدور.',
        ],
    ],
    'roles'            => [
        'name'         => 'الأدوار',
        'instructions' => 'حد د الأدوار التي ينتمي إليها المستخدم.',
    ],
    'permissions'      => [
        'name' => 'الصلاحيات',
    ],
    'last_activity_at' => [
        'name' => 'أخر نشاط',
    ],
    'activated'        => [
        'name'         => 'مُنشط',
        'label'        => 'هل هذا المستخدم مُنشط?',
        'instructions' => 'المستخدم لا يمكنه تسجيل الدخول حتى يتم تنشيط حسابه.',
    ],
    'enabled'          => [
      'name'         => 'مفعل',
      'label'        => 'هل هذا المستخدم مفعل?',
      'instructions' => 'المستخدم لا يمكنه تسجيل الدخول حتى يتم تفعيل حسابه.',
    ],
    'activation_code'  => [
        'name' => 'رمز التنشيط',
    ],
    'reset_code'       => [
        'name' => 'رمز إعادة كلمة المرور',
    ],
    'remember_me'      => [
        'name' => 'تذكرني',
    ],
    'status'           => [
        'name'   => 'الحالة',
        'option' => [
            'active'   => 'نشط',
            'inactive' => 'غير نشط',
            'disabled' => 'معطل',
        ],
    ],
];
