<?php

return [
    'related'    => [
        'label'        => 'Corrent relacionat',
        'instructions' => 'Especifiqueu les entrades de flux relacionades que es mostraran al menú desplegable.',
    ],
    'mode'       => [
        'label'  => 'Mode d\'entrada',
        'option' => [
            'tags'       => 'Etiquetes',
            'lookup'     => 'Cercar',
            'checkboxes' => 'Caselles de selecció',
        ],
    ],
    'min'        => [
        'label'        => 'Seleccions mínimes',
        'instructions' => 'Especifiqueu el nombre mínim de seleccions permeses.',
    ],
    'max'        => [
        'label'        => 'Seleccions màximes',
        'instructions' => 'Especifiqueu el nombre màxim de seleccions permeses.',
    ],
    'title_name' => [
        'label'        => 'Camp del títol',
        'placeholder'  => 'nom',
        'instructions' => 'Especifiqueu el <strong>slug</strong> de camp que es mostrarà per a les opcions desplegables / de cerca.<br>Podeu especificar títols analitzables com <strong>{entry.first_name} {entry.last_name}</strong><br>per defecte s\'utilitzarà la columna de títol del flux relacionat.',
    ],
];
