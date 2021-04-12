<?php

return [
    'folders' => [
        'name'         => 'Gidse',
        'instructions' => 'Spesifiseer watter vouers vir hierdie veld beskikbaar is. Laat leeg om alle vouers te vertoon.',
        'warning'      => 'Bestaande vouertoestemmings geniet voorkeur bo geselekteerde vouers.',
    ],
    'max'     => [
        'name'         => 'Maksimum oplaaigrootte',
        'instructions' => 'Spesifiseer die maksimum oplaaigrootte in <strong>megagrepe</strong>.',
        'warning'      => 'As dit nie gespesifiseer word nie, word die maksimum voumap en dan die bedienermaks gebruik.',
    ],
    'mode'    => [
        'name'         => 'Invoermodus',
        'instructions' => 'Hoe moet gebruikers lêerinvoer verskaf?',
        'option'       => [
            'default' => 'Laai lêers op en / of kies dit.',
            'select'  => 'Kies slegs lêers.',
            'upload'  => 'Laai slegs lêers op.',
        ],
    ],
];
