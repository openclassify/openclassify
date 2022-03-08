<?php

return [
    'max_upload_size'      => [
        'name'         => 'الحجم الأعلى للرفع',
        'instructions' => 'حدد أعلى حجم ممكن للرفع.',
        'warning'      => 'الحجم الأعلى المحدد للرفع على مخدمك: ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'الحد الأعلى للرفع المتوازي',
        'instructions' => 'حدد أعلى عدد للمفات يمكن تحميلها بنفس الوقت.',
    ],
];
