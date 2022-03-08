<?php

return [
    'folders' => [
        'name'         => 'Folders',
        'instructions' => 'Specify which folders are available for this field. Leave blank to display all folders.',
        'warning'      => 'Existing folder permissions take precedence over selected folders.',
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
