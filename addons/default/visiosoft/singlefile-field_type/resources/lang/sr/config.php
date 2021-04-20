<?php

return [
    'folders' => [
        'name'         => 'Folderi',
        'instructions' => 'Navedite koje su fascikle dostupne za ovo polje. Ostavite prazno za prikaz svih direktorijuma.',
        'warning'      => 'Postojeće dozvole za fascikle imaju prednost nad odabranim direktorijumima.',
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
