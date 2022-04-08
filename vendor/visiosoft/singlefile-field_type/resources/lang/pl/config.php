<?php

return [
    'folders' => [
        'name'         => 'Lornetka składana',
        'instructions' => 'Określ, które foldery są dostępne dla tego pola. Pozostaw puste, aby wyświetlić wszystkie foldery.',
        'warning'      => 'Istniejące uprawnienia do folderów mają pierwszeństwo przed wybranymi folderami.',
    ],
    'max'     => [
        'name'         => 'Maksymalny rozmiar przesyłania',
        'instructions' => 'Określ maksymalny rozmiar wysyłania w <strong>megabajtach</strong>.',
        'warning'      => 'Jeśli nie zostanie określony, zamiast tego zostanie użyty maks. Folder, a następnie maks. Serwer.',
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
