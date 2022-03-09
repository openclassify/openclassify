<?php

return [
    'field'        => [
        'name'         => 'Veld',
        'label'        => 'Veld',
        'instructions' => 'Kies een veld om toe te wijzen.',
    ],
    'label'        => [
        'name'         => 'Label',
        'instructions' => 'Label\'s worden alleen voor forms gebruikt. Als dit leeg blijft, wordt de veldnaam gebruikt.',
    ],
    'required'     => [
        'name'         => 'Verplicht',
        'label'        => 'Is dit veld verplicht?',
        'instructions' => 'Als dit veld verplicht is, dan moet het altijd ingevuld zijn.',
    ],
    'unique'       => [
        'name'         => 'Uniek',
        'label'        => 'Is dit veld uniek?',
        'instructions' => 'Als dit veld uniek is, dan moet het een unieke waarde hebben.',
    ],
    'searchable'   => [
        'name'         => 'Doorzoekbaar',
        'label'        => 'Is dit veld doorzoekbaar?',
        'instructions' => 'Alleen doorzoekbare velden zullen worden geïndexeerd.',
    ],
    'placeholder'  => [
        'name'         => 'Placeholder',
        'instructions' => 'Als placeholders ondersteund worden, worden deze in de input weergegeven als er niets is ingevuld.',
    ],
    'translatable' => [
        'name'         => 'Vertaalbaar',
        'label'        => 'Is dit veld vertaalbaar?',
        'instructions' => 'Als het veld vertaalbaar is, zullen alle ingeschakelde locales beschikbaar zijn.',
        'column_type'  => 'Het geassocieerde veld type ondersteund geen vertaalbare waardes.',
        'stream'       => 'De geassocieerde stream is niet vertaalbaar.',
    ],
    'instructions' => [
        'name'         => 'Instructies',
        'instructions' => 'Veld instructies zullen worden weergegeven in forms om gebruikers te helpen.',
    ],
    'warning'      => [
        'name'         => 'Waarschuwing',
        'instructions' => 'Waarschuwingen helpen te attenderen voor belangrijke informatie',
    ],
];
