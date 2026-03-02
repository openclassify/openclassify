<?php

return [
    'folders' => [
        'name'         => 'Cartelle',
        'instructions' => 'Specifica quali cartelle sono disponibili per questo campo. Lascia vuoto per visualizzare tutte le cartelle.',
        'warning'      => 'Le autorizzazioni per le cartelle esistenti hanno la precedenza sulle cartelle selezionate.',
    ],
    'max'     => [
        'name'         => 'Dimensione massima di caricamento',
        'instructions' => 'Specifica la dimensione massima del caricamento in <strong>megabyte</strong>.',
        'warning'      => 'Se non specificato, verrà invece utilizzata la cartella max e quindi max server.',
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
