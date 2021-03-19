<?php

return [
    'folders' => [
        'name'         => 'Mapper',
        'instructions' => 'Spesifiser hvilke mapper som er tilgjengelige for dette feltet. La det være tomt for å vise alle mappene.',
        'warning'      => 'Eksisterende mappetillatelser går foran valgte mapper.',
    ],
    'max'     => [
        'name'         => 'Maks opplastningsstørrelse',
        'instructions' => 'Spesifiser maks opplastningsstørrelse i <strong>megabyte</strong>.',
        'warning'      => 'Hvis ikke spesifisert, vil mappen max og server max bli brukt i stedet.',
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
