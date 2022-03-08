<?php

return [
    'folders' => [
        'name'         => 'Folders',
        'instructions' => 'Specify which folders are available for this field. Leave blank to display all folders.',
        'warning'      => 'Existing folder permissions take precedence over selected folders.',
    ],
    'min'     => [
        'label'        => 'Minimum Selections',
        'instructions' => 'Enter the minimum number of allowed selections.',
    ],
    'max'     => [
        'label'        => 'Maximum Selections',
        'instructions' => 'Enter the maximum number of allowed selections.',
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
