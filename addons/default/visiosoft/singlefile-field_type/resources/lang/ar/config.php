<?php

return [
    'folders' => [
        'name'         => 'المجلدات',
        'instructions' => 'حدد المجلد المتاح لهذا الحقل. اتركه فارغاً إذا أردت عرض كل المجلدات.',
        'warning'      => 'صلاحيات المجلد الحالية لديهاأولوية أكثر من المجلدات المختارة.',
    ],
    'max'     => [
        'name'         => 'Max Upload Size',
        'instructions' => 'Specify the max upload size in <strong>megabytes</strong>.',
        'warning'      => 'If not specified the folder max and then server max will be used instead.',
    ],
    'mode'    => [
        'name'         => 'Input Mode',
        'instructions' => 'How should users provide file input?',
        'option'       => [
            'default' => 'Upload and/or select files.',
            'select'  => 'Select files only.',
            'upload'  => 'Upload files only.',
        ],
    ],
];
