<?php

return [
    'related'    => [
        'label'        => 'Corriente relacionada',
        'instructions' => 'Especifique las entradas de flujo relacionadas para mostrar en el menú desplegable.',
    ],
    'mode'       => [
        'label'  => 'Modo de entrada',
        'option' => [
            'tags'       => 'Etiquetas',
            'lookup'     => 'Buscar',
            'checkboxes' => 'Casillas de verificación',
        ],
    ],
    'min'        => [
        'label'        => 'Selecciones mínimas',
        'instructions' => 'Especifique el número mínimo de selecciones permitidas.',
    ],
    'max'        => [
        'label'        => 'Selecciones máximas',
        'instructions' => 'Especifique el número máximo de selecciones permitidas.',
    ],
    'title_name' => [
        'label'        => 'Campo de título',
        'placeholder'  => 'primer nombre',
        'instructions' => 'Especifique el <strong>slug</strong> del campo para mostrar las opciones de búsqueda / menú desplegable.<br>Puede especificar títulos analizables como <strong>{entry.first_name} {entry.last_name}</strong><br>La columna de título de la secuencia relacionada se utilizará de forma predeterminada.',
    ],
];
