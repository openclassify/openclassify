<?php

return [
    'folders' => [
        'name'         => 'Mapper',
        'instructions' => 'Spesifiser hvilke mapper som er tilgjengelige for dette feltet. La det være tomt for å vise alle mappene.',
        'warning'      => 'Eksisterende mappetillatelser går foran valgte mapper.',
    ],
    'min'     => [
        'label'        => 'Minimumsvalg',
        'instructions' => 'Angi minimum antall tillatte valg.',
    ],
    'max'     => [
        'label'        => 'Maksimale valg',
        'instructions' => 'Angi maksimalt antall tillatte valg.',
    ],
    'mode'    => [
        'name'         => 'Inndatamodus',
        'instructions' => 'Hvordan skal brukere gi filinndata?',
        'option'       => [
            'default' => 'Last opp og / eller velg filer.',
            'select'  => 'Velg bare filer.',
            'upload'  => 'Bare last opp filer.',
        ],
    ],
];
