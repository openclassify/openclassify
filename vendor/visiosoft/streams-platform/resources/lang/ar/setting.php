<?php

return [
    'name'              => [
        'label'        => 'اسم الموقع',
        'instructions' => 'ماهو اسم تطبيقك?',
        'placeholder'  => trans('distribution::addon.name'),
    ],
    'description'       => [
        'label'        => 'وصف الموقع',
        'instructions' => 'ماهو وصف أو شعار تطبيقك?',
        'placeholder'  => trans('distribution::addon.description'),
    ],
    'business'          => [
        'label'        => 'اسم العمل',
        'instructions' => 'ماهو اسم عملك القانوني?',
    ],
    'phone'             => [
        'label'        => 'رقم هاتف الاتصال',
        'instructions' => 'حدد رقم هاتف الاتصال العام.',
    ],
    'address'           => [
        'label' => 'العنوان',
    ],
    'address2'          => [
        'label' => 'شقة، جناح، الخ.',
    ],
    'city'              => [
        'label' => 'المدينة',
    ],
    'state'             => [
        'label' => 'الدولة / مقاطعة',
    ],
    'postal_code'       => [
        'label' => 'الرمز البريدي',
    ],
    'country'           => [
        'label' => 'البلد',
    ],
    'timezone'          => [
        'label'        => 'المنطقة الزمنية',
        'instructions' => 'حدد المنطقة الزمنية لموقعك.',
    ],
    'unit_system'       => [
        'label'        => 'نظام الوحدات',
        'instructions' => 'ماهو نظام الوحدات لموقعك.',
        'option'       => [
            'imperial' => 'النظام الامبراطوري',
            'metric'   => 'النظام المتري',
        ],
    ],
    'currency'          => [
        'label'        => 'العملة',
        'instructions' => 'حدد العملة الافتراضية لموقعك.',
    ],
    'date_format'       => [
        'label'        => 'صيغة التاريخ',
        'instructions' => 'حدد صيغة التاريخ المفضلة لموقعك.',
    ],
    'time_format'       => [
        'label'        => 'صيغة الوقت',
        'instructions' => 'حدد صيغة الوقت المفضلة لموقعك.',
    ],
    'default_locale'    => [
        'label'        => 'اللغة',
        'instructions' => 'حدد اللغة الافتراضية لموقعك.',
    ],
    'enabled_locales'   => [
        'label'        => 'تفعيل اللغات',
        'instructions' => 'حدد ماهي اللغات المتاحة على موقعك.',
    ],
    'maintenance'       => [
        'label'        => 'وضع الصيانة',
        'instructions' => 'استخدام هذا الخيار لتعطيل الصفحة العامة على نظامك.<br>هذا مفيد عندا تريد ايقاف الموقع للصيانة أو التطوير.',
    ],
    'debug'             => [
        'label'        => 'وضع التصحيح',
        'instructions' => 'عندما يكون مفعل , بتم اظهر رسالة مفصلة عن الأخطاء.',
    ],
    'ip_whitelist'      => [
        'label'        => 'القائمة البيضاء لـ IP',
        'instructions' => 'عندما يتم تفعيل وضع الصيانة , عناوين ال IP سيتم السماح لها بالوصول إلى الصفحة الرئيسية للتطبيق.',
        'placeholder'  => 'افصل بين كل IP بفاصلة.',
    ],
    'basic_auth'        => [
        'label'        => 'تأكيد المصادقة?',
        'instructions' => 'عندما يكون وضع الصيانة مفعل , تأكيد المستخدم لمصادقة HTTP?',
    ],
    '503_message'       => [
        'label'        => 'رسالة غير متوفر',
        'instructions' => 'عندما يكون الموقع معطل أول هناك مشكلة , هذه الرسالة سوف تظهر للمستخدمين.',
        'placeholder'  => 'هد لاحقاً.',
    ],
    'email'             => [
        'label'        => 'البريد الالكتروني للنظام',
        'instructions' => 'حدد البريد الالكتروني الافتراضي لنظام توليد الرسائل.',
        'placeholder'  => 'example@domain.com',
    ],
    'sender'            => [
        'label'        => 'اسم المرسل',
        'instructions' => 'حدد اسم المرسل ليتم استخدمه من قبل نظام توليد الرسائل.',
    ],
    'standard_theme'    => [
        'label'        => 'السمة العامة',
        'instructions' => 'ما هي السمة التي تريد استخدامها للموقع العام?',
    ],
    'admin_theme'       => [
        'label'        => 'السمة الادارية',
        'instructions' => 'ماهي السمة التي تريد استخدامها للوحة التحكم?',
    ],
    'per_page'          => [
        'label'        => 'النتائج كل صفحة',
        'instructions' => 'حدد عدد النتائج كل صفحة.',
    ],
];
