<?php

return [
    'related'    => [
        'label'        => 'Gerelateerde stream',
        'instructions' => 'Geef de gerelateerde streamvermeldingen op die in de vervolgkeuzelijst moeten worden weergegeven.',
    ],
    'mode'       => [
        'label'  => 'Invoer modus',
        'option' => [
            'tags'       => 'Tags',
            'lookup'     => 'Opzoeken',
            'checkboxes' => 'Selectievakjes',
        ],
    ],
    'min'        => [
        'label'        => 'Minimale selecties',
        'instructions' => 'Specificeer het minimum aantal toegestane selecties.',
    ],
    'max'        => [
        'label'        => 'Maximale selecties',
        'instructions' => 'Specificeer het maximum aantal toegestane selecties.',
    ],
    'title_name' => [
        'label'        => 'Titelveld',
        'placeholder'  => 'Voornaam',
        'instructions' => 'Specificeer <strong>slug</strong> van veld om weer te geven voor vervolgkeuzelijst / zoekopties.<br>U kunt parseerbare titels specificeren, zoals <strong>{entry.first_name} {entry.last_name}</strong><br>De titelkolom van de gerelateerde stream wordt standaard gebruikt.',
    ],
];
