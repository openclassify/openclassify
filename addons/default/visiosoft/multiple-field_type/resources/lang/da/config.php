<?php

return [
    'related'    => [
        'label'        => 'Relateret strøm',
        'instructions' => 'Angiv de relaterede strømindgange, der skal vises i rullemenuen.',
    ],
    'mode'       => [
        'label'  => 'Input-tilstand',
        'option' => [
            'tags'       => 'Mærker',
            'lookup'     => 'Kig op',
            'checkboxes' => 'Afkrydsningsfelter',
        ],
    ],
    'min'        => [
        'label'        => 'Minimumsvalg',
        'instructions' => 'Angiv det mindste antal tilladte valg.',
    ],
    'max'        => [
        'label'        => 'Maksimale valg',
        'instructions' => 'Angiv det maksimale antal tilladte valg.',
    ],
    'title_name' => [
        'label'        => 'Titelfelt',
        'placeholder'  => 'fornavn',
        'instructions' => 'Angiv <strong>slug</strong> i feltet, der skal vises, for rullemenu / søgemuligheder.<br>Du kan specificere parsable titler som <strong>{entry.first_name} {entry.last_name}</strong><br>Den relaterede streams titelsøjle bruges som standard.',
    ],
];
