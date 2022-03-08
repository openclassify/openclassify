<?php

return [
    'mode'          => [
        'label'  => 'وضع الادخال',
        'option' => [
            'checkboxes' => 'مربعات الادخال',
            'tags'       => 'الوسوم',
        ]
    ],
    'options'       => [
        'label'        => 'الخيارات',
        'instructions' => 'ادخل الخيارات في الاسفل <strong>key: Value</strong> أو <strong>Value</strong> تنسيق فقط. ادخل كل خيار في سطر جديد.',
        'placeholder'  => 'key: Value'
    ],
    'min'           => [
        'label'        => 'الحد الأدنى للاختيار',
        'instructions' => 'ادخل الرقم المسموح به للحد الأدنى للاختيار.'
    ],
    'max'           => [
        'label'        => 'الحد الأعلى للاختيار',
        'instructions' => 'ادخل العدد المسموح به للحد الأدنى للاختيار.'
    ],
    'default_value' => [
        'label'        => 'القيمة الافتراضية',
        'instructions' => 'ادخل الاختيارات الافتراضية.'
    ]
];
