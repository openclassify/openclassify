<?php

return [
    'related'    => [
        'label'        => 'Powiązany strumień',
        'instructions' => 'Określ powiązane wpisy strumieni, które mają być wyświetlane na liście rozwijanej.',
    ],
    'mode'       => [
        'label'  => 'Tryb wejściowy',
        'option' => [
            'tags'       => 'Tagi',
            'lookup'     => 'Wyszukaj',
            'checkboxes' => 'Pola wyboru',
        ],
    ],
    'min'        => [
        'label'        => 'Minimalne wybory',
        'instructions' => 'Określ minimalną liczbę dozwolonych wyborów.',
    ],
    'max'        => [
        'label'        => 'Maksymalne wybory',
        'instructions' => 'Określ maksymalną liczbę dozwolonych wyborów.',
    ],
    'title_name' => [
        'label'        => 'Pole tytułu',
        'placeholder'  => 'Imię',
        'instructions' => 'Określ <strong>slug</strong> pola, które ma być wyświetlane dla opcji menu rozwijanego / wyszukiwania.<br>Możesz określić tytuły do analizy, takie jak <strong>{entry.first_name} {entry.last_name}</strong><br>Kolumna tytułu powiązanego strumienia będzie używana domyślnie.',
    ],
];
