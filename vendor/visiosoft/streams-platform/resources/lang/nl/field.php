<?php

return [
    'name'         => [
        'name'         => 'Naam',
        'instructions' => 'Wat is de naam van het veld?',
    ],
    'slug'         => [
        'name'         => 'Slug',
        'instructions' => 'De slug wordt o.a. gebruikt voor de database kolomnaam.',
    ],
    'description'  => [
        'name'         => 'Omschrijving',
        'instructions' => 'Vul een korte omschrijving in.',
    ],
    'type'         => [
        'name'         => 'Veldtype',
        'instructions' => 'Welk veldtype wil je gebruiken voor dit veld?',
        'warning'      => 'Het veranderen van deze waarde zal onmiddelijk de pagina herladen.',
    ],
    'placeholder'  => [
        'name'         => 'Placeholder',
        'instructions' => 'Als het ondersteund wordt, placeholders worden weergegeven in de input als er niets bij is ingevuld.',
    ],
    'title_column' => [
        'name'         => 'Titel kolom',
        'instructions' => 'Laat de veldslug als titel zien?',
    ],
    'instructions' => [
        'name'         => 'Instructies',
        'instructions' => 'Veldinstructies worden in formulieren weergegeven om gebruikers te assisteren',
    ],
    'warning'      => [
        'name'         => 'Waarschuwing',
        'instructions' => 'Waarschuwingen helpen te attenderen voor belangrijke informatie.',
    ],
    'translatable' => [
        'name'         => 'Vertaalbaar',
        'instructions' => 'Zijn de ingaves in deze stream meertalig?',
        'warning'      => 'De stream moet vertaalbaalbaar zijn voor vertaalbare velden om juist te werken.',
    ],
    'trashable'    => [
        'name'         => 'In prullenbak gooien',
        'instructions' => 'Moeten ingaves eerst in een prullenbak terecht komen in plaats van ze meteen permanent te verwijderen?',
    ],
    'versionable'  => [
        'name'         => 'Versionable',
        'instructions' => 'Wil je elke verandering bijhouden bij elke keer nadat ze opgeslagen worden?',
    ],
    'sortable'     => [
        'name'         => 'Sorteerbaar',
        'instructions' => 'Zijn de ingaves in deze stream sorteerbaar?',
    ],
    'searchable'   => [
        'name'         => 'Doorzoekbaar',
        'instructions' => 'Zijn de ingaves in deze stream doorzoekbaar?',
    ],
    'config'       => [
        'name'         => 'Configuratie',
        'instructions' => 'Specificeer elke optionele configuratie met het gebruik van JSON.',
    ],
];
