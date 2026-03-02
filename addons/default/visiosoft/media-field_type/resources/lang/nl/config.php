<?php

return [
    'folders' => [
        'name'         => 'Mappen',
        'instructions' => 'Specificeer welke mappen beschikbaar zijn voor dit veld. Laat leeg om alle mappen weer te geven.',
        'warning'      => 'Bestaande mapmachtigingen hebben voorrang op geselecteerde mappen.',
    ],
    'min'     => [
        'label'        => 'Minimale selecties',
        'instructions' => 'Voer het minimum aantal toegestane selecties in.',
    ],
    'max'     => [
        'label'        => 'Maximale selecties',
        'instructions' => 'Voer het maximale aantal toegestane selecties in.',
    ],
    'mode'    => [
        'name'         => 'Invoer modus',
        'instructions' => 'Hoe moeten gebruikers bestandsinvoer verstrekken?',
        'option'       => [
            'default' => 'Upload en / of selecteer bestanden.',
            'select'  => 'Selecteer alleen bestanden.',
            'upload'  => 'Upload alleen bestanden.',
        ],
    ],
];
