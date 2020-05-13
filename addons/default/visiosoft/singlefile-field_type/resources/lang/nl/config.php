<?php

return [
    'folders' => [
        'name'         => 'Mappen',
        'instructions' => 'Specificeer welke mappen beschikbaar zijn voor dit veld. Laat leeg om alle mappen weer te geven.',
        'warning'      => 'Bestaande mapmachtigingen hebben voorrang op geselecteerde mappen.',
    ],
    'max'     => [
        'name'         => 'Maximale uploadgrootte',
        'instructions' => 'Geef de maximale uploadgrootte op in <strong>megabytes</strong>.',
        'warning'      => 'Indien niet gespecificeerd, wordt in plaats daarvan de map max en vervolgens de server max gebruikt.',
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
