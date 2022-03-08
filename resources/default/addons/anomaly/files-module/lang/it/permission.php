<?php

return [
    'files'   => [
        'name'   => 'File',
        'option' => [
            'read'   => 'Può accedere alla sezione file?',
            'write'  => 'Può caricare e modificare file?',
            'delete' => 'Può cancellare file?',
        ],
    ],
    'folders' => [
        'name'   => 'Cartelle',
        'option' => [
            'read'   => 'Può accedere alla sezione cartelle?',
            'write'  => 'Può creare e modificare cartelle?',
            'delete' => 'Può cancellare cartelle?',
        ],
    ],
    'disks'   => [
        'name'   => 'Dischi',
        'option' => [
            'read'   => 'Può vedere i dischi?',
            'write'  => 'Può creare e modificare i dischi?',
            'delete' => 'Può cancellare i dischi?',
        ],
    ],
    'fields'  => [
        'name'   => 'Campi',
        'option' => [
            'manage' => 'Può gestire i campi personalizzati?',
        ],
    ],
];
