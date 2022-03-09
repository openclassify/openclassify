<?php

return [
    'name'             => [
        'name'         => 'نام',
        'instructions' => [
            'types'      => 'یک نام خوب برای این کتگوری انتخاب کنید',
            'categories' => 'یک نام خوب برای این کتگوری انتخاب کنید',
        ],
    ],
    'title'            => [
        'name'         => 'عنوان',
        'instructions' => 'یک نام خوب برای این پست',
    ],
    'slug'             => [
        'name'         => 'اسلاگ',
        'instructions' => [
            'types'      => 'اسلاگ برای ایجاد تیبل در دیتابیس برای این نوع پست به کار می رود',
            'categories' => 'در لینک این کتگوری استفاده می شود',
            'posts'      => 'در لینک ای پست استفاده می شود',
        ],
    ],
    'description'      => [
        'name'         => 'شرح',
        'instructions' => [
            'types'      => 'این پست را شرح دهید',
            'categories' => 'این کتگوری را شرح دهید',
        ],
        'warning'      => 'ممکن است به برای عموم قابل مشاهده باشد بسته به اینکه سایت شما چطور ساخته شده است',
    ],
    'summary'          => [
        'name'         => 'چکیده',
        'instructions' => 'چکیده ی مختصری از موضوع را بنویسید',
    ],
    'category'         => [
        'name'         => 'کتگوری',
        'instructions' => 'به کدام کتگوری تعلق دارد؟',
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The post title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'meta_keywords'    => [
        'name'         => 'Meta Keywords',
        'instructions' => 'Specify the SEO keywords.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Specify the theme layout to wrap the <strong>post layout</strong> with.',
    ],
    'layout'           => [
        'name'         => 'Post Layout',
        'instructions' => 'The layout is used for displaying the post\'s content.',
    ],
    'tags'             => [
        'name'         => 'تگ ها',
        'instructions' => 'تگ ها برای سازماندهی پست ها به کار می روند',
    ],
    'enabled'          => [
        'name'         => 'فعال',
        'label'        => 'آیا این پست فعال هست؟',
        'instructions' => 'اگر فعال نباشد به صورت عمومی قابل مشاهده نیست اما شما همچنان می توانید آن را مشاهده کنید',
        'warning'      => 'این پست باید فعال باشد تا به صورت <strong>عمومی</strong> قابل مشاهده باشد',
    ],
    'featured'         => [
        'name'         => 'برگزیده',
        'label'        => 'آیا این یک پست برگزیده است؟',
        'instructions' => 'پست های برگزیده برای جلب توجه مخاطب به این پست هستند.',
        'warning'      => 'بسته به اینکه سایت شما چطور ساخته می شود ممکن است تاثیری نداشته باشد',
    ],
    'publish_at'       => [
        'name'         => 'تاریخ انتشار',
        'instructions' => 'تاریخ انتشار پست را مشخص کنید',
        'warning'      => 'اگر زمان پست در آینده تنظیم شود، تا آن زمان قابل مشاهده نیست.',
    ],
    'author'           => [
        'name'         => 'نویسنده',
        'instructions' => 'نویسنده ای که عموم آن را می بینند را مشخص کنید',
    ],
    'status'           => [
        'name'   => 'وضعیت',
        'option' => [
            'live'      => 'فعال',
            'draft'     => 'پیش نویس',
            'scheduled' => 'برای بعد',
        ],
    ],
    'content'          => [
        'name' => 'محتوا',
    ],
];
