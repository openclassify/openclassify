<?php

return [
    'folders' => [
        'name'         => 'Mapper',
        'instructions' => 'Angiv, hvilke mapper der er tilgængelige for dette felt. Lad det være tomt for at få vist alle mapper.',
        'warning'      => 'Eksisterende mappetilladelser har forrang over valgte mapper.',
    ],
    'min'     => [
        'label'        => 'Minimumsvalg',
        'instructions' => 'Indtast det mindste antal tilladte valg.',
    ],
    'max'     => [
        'label'        => 'Maksimale valg',
        'instructions' => 'Indtast det maksimale antal tilladte valg.',
    ],
    'mode'    => [
        'name'         => 'Input-tilstand',
        'instructions' => 'Hvordan skal brugerne levere filinput?',
        'option'       => [
            'default' => 'Upload og / eller vælg filer.',
            'select'  => 'Vælg kun filer.',
            'upload'  => 'Upload kun filer.',
        ],
    ],
];
