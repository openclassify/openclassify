<?php

return [
    'mode'          => [
        'label'        => 'حالت',
        'instructions' => 'تمایل دارین از چه فیلدی استفاده شود؟',
        'option'       => [
            'input'    => 'Text Input',
            'dropdown' => 'Dropdown',
            'search'   => 'Search',
        ],
    ],
    'top_options'   => [
        'name'         => 'گزینه های بالای لیست',
        'instructions' => 'کد کشور هایی که تمایل دارین بالای لیست باشن رو به صورت ISO Alpha-2 وارد کنید. هر گزینه در یک سطر',
        'placeholder'  => "US\nCA\nMX",
    ],
    'default_value' => [
        'name'         => 'مقدار پیش فرض',
        'instructions' => 'اگر می خواین می تونین یک مقدار پیش فرض تعیین کنین',
    ],
];
