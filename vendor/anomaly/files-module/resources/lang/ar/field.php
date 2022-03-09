<?php

return [
    'name'          => [
        'name'         => 'الأسم',
        'instructions' => [
            'disks'   => 'حدد اسم قصير يصف القرص.',
            'folders' => 'حدد اسم قصير يصف المجلد.',
            'files'   => 'حدد اسم الملف.',
        ],
    ],
    'title'         => [
        'name'         => 'عنوان',
        'instructions' => 'حدد اسم قصير يصف الملف.',
    ],
    'slug'          => [
        'name'         => 'Slug المعرف',
        'instructions' => 'المعرف يستخدم لبناء مكان التخزين.',
    ],
    'size'          => [
        'name' => 'الحجم',
    ],
    'disk'          => [
        'name'         => 'القرس',
        'instructions' => 'حدد أي قرص ينتمي إليه هذا المجلد.',
    ],
    'folder'        => [
        'name' => 'المحلد',
    ],
    'adapter'       => [
        'name' => 'الوصلة',
    ],
    'keywords'      => [
        'name'         => 'الكلمات المفتاحية',
        'instructions' => 'حدد كلمات مفتاحية مصنفة لمساعدتك في تجميع الملفات.',
    ],
    'mime_type'     => [
        'name' => 'MIME نوع',
    ],
    'preview'       => [
        'name' => 'عرض',
    ],
    'description'   => [
        'name'         => 'الوصف',
        'instructions' => [
            'disks'  => 'صف القرص باختصار.',
            'folder' => 'صف المجلد باختصار.',
            'files'  => 'صف الملف باختصار.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'الأنواع المسموح بها',
        'instructions' => 'حدد لاحقات الملف المسموح بها في هذا المجلد.',
        'warning'      => 'انتبه للاختلاف المناسب بي نوع mime مثل jpg و jpeg.',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
];
