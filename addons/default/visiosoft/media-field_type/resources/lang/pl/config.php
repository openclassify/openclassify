<?php

return [
    'folders' => [
        'name'         => 'Lornetka składana',
        'instructions' => 'Określ, które foldery są dostępne dla tego pola. Pozostaw puste, aby wyświetlić wszystkie foldery.',
        'warning'      => 'Istniejące uprawnienia do folderów mają pierwszeństwo przed wybranymi folderami.',
    ],
    'min'     => [
        'label'        => 'Minimalna selekcja',
        'instructions' => 'Wprowadź minimalną liczbę dozwolonych wyborów.',
    ],
    'max'     => [
        'label'        => 'Maksymalna liczba wyborów',
        'instructions' => 'Wprowadź maksymalną liczbę dozwolonych wyborów.',
    ],
    'mode'    => [
        'name'         => 'Tryb wprowadzania',
        'instructions' => 'W jaki sposób użytkownicy powinni wprowadzać pliki?',
        'option'       => [
            'default' => 'Prześlij i / lub wybierz pliki.',
            'select'  => 'Wybierz tylko pliki.',
            'upload'  => 'Prześlij tylko pliki.',
        ],
    ],
];
