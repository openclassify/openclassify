<?php

return [
    'folders' => [
        'name'         => 'المجلدات',
        'instructions' => 'Specify which folders are available for this field. Leave blank to display all folders.',
        'warning'      => 'Existing folder permissions take precedence over selected folders.',
    ],
    'min'     => [
        'label'        => 'الحد الأدنى للاختيارت',
        'instructions' => 'ادخل رقم الحد الأدنى للاخيارات المسموح بها',
    ],
    'max'     => [
        'label'        => 'الحد الأعلى للاختيارات',
        'instructions' => 'ادخل رقم الحد الأعلى للاخيارات المسموح بها.',
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
