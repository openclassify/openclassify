<?php

return [
    'related'    => [
        'label'        => 'Relatert strøm',
        'instructions' => 'Spesifiser de relaterte strømoppføringene som skal vises i rullegardinmenyen.',
    ],
    'mode'       => [
        'label'  => 'Inndatamodus',
        'option' => [
            'tags'       => 'Merker',
            'lookup'     => 'Se opp',
            'checkboxes' => 'Avkrysningsruter',
        ],
    ],
    'min'        => [
        'label'        => 'Minimumsvalg',
        'instructions' => 'Spesifiser minimum antall tillatte valg.',
    ],
    'max'        => [
        'label'        => 'Maksimum utvalg',
        'instructions' => 'Spesifiser maksimalt antall tillatte valg.',
    ],
    'title_name' => [
        'label'        => 'Tittelfelt',
        'placeholder'  => 'fornavn',
        'instructions' => 'Spesifiser <strong>slug</strong> i feltet som skal vises for rullegardin / søkealternativer.<br>Du kan spesifisere parsable titler som <strong>{entry.first_name} {entry.last_name}</strong><br>Den relaterte streamens tittelkolonne vil bli brukt som standard.',
    ],
];
