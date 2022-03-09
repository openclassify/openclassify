<?php

return [
    'type'       => [
        'label'        => 'نوع افزونه',
        'instructions' => 'در نظر دارین چه نوع افزونه ای رو اضافه کنید؟',
        'placeholder'  => 'همه افزونه ها',
    ],
    'search'     => [
        'label'        => 'جستجوی اکستنشن ها',
        'instructions' => 'If the "Extensions" addon type is selected, you can define an optional search parameter here to return only extensions providing a specific service.',
        'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'        => 'نوع قالب',
        'instructions' => 'If the "Themes" addon type is selected, you can optional limit themes to admin or public themes only.',
        'placeholder'  => 'ادمین + همه',
        'admin'        => 'ادمین',
        'public'       => 'همه',
    ],
];
