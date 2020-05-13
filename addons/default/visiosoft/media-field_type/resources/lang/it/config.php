<?php

return [
    'folders' => [
        'name'         => 'Cartelle',
        'instructions' => 'Specifica quali cartelle sono disponibili per questo campo. Lascia vuoto per visualizzare tutte le cartelle.',
        'warning'      => 'Le autorizzazioni per le cartelle esistenti hanno la precedenza sulle cartelle selezionate.',
    ],
    'min'     => [
        'label'        => 'Selezioni minime',
        'instructions' => 'Immettere il numero minimo di selezioni consentite.',
    ],
    'max'     => [
        'label'        => 'Selezioni massime',
        'instructions' => 'Immettere il numero massimo di selezioni consentite.',
    ],
    'mode'    => [
        'name'         => 'Modalità di immissione',
        'instructions' => 'In che modo gli utenti devono fornire input di file?',
        'option'       => [
            'default' => 'Carica e / o seleziona file.',
            'select'  => 'Seleziona solo i file.',
            'upload'  => 'Carica solo file.',
        ],
    ],
];
