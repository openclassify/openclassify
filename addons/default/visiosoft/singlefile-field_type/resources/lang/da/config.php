<?php

return [
    'folders' => [
        'name'         => 'Mapper',
        'instructions' => 'Angiv, hvilke mapper der er tilgængelige for dette felt. Lad det være tomt for at få vist alle mapper.',
        'warning'      => 'Eksisterende mappetilladelser har forrang over valgte mapper.',
    ],
    'max'     => [
        'name'         => 'Maks. Uploadstørrelse',
        'instructions' => 'Angiv den maksimale uploadstørrelse i <strong>megabyte</strong>.',
        'warning'      => 'Hvis ikke angivet, vil mappen max og derefter server max blive brugt i stedet.',
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
