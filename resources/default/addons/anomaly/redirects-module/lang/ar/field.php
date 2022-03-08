<?php

return [
    'from'   => [
        'name'         => 'من',
        'label'        => 'توجيه من',
        'placeholder'  => 'foo/bar/{var}',
        'instructions' => 'حدد المسار أو النمط للتوجيه على سبيل المثال: <strong>foo/bar/{var}</strong> or <strong>foo/bar</strong> or <strong>http://{account}.old.com/{path}</strong>.',
    ],
    'to'     => [
        'name'         => 'إلى',
        'label'        => 'توجيه إلى',
        'placeholder'  => 'bar/{var}',
        'instructions' => 'حدد المسار أو النمط البديل أو URL للتوجيه إليه , على سبيل المثال:  <strong>bar/{var}</strong> or <strong>bar/baz</strong> or <strong>https://new.com/account/{account}/{path}</strong>.',
    ],
    'status' => [
        'name'         => 'الحالة',
        'instructions' => 'ما هو نوع التوجيه?',
        'option'       => [
            '301' => '301 - توجيه دائم',
            '302' => '302 - توجيه مؤقت',
        ],
    ],
    'secure' => [
        'name'         => 'الأمان',
        'label'        => 'التوجيه إلى رابط آمن?',
        'instructions' => 'هل تريد اجبار التوجيه على اتصال آمن?',
        'warning'      => 'هذا الخيار يتم تجاهله إذا كان متضمن ضمن قيمة  <strong>التوجيه إلى</strong>.',
    ],
];
