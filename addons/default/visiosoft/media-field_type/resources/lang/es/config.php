<?php

return [
    'folders' => [
        'name'         => 'Carpetas',
        'instructions' => 'Especifique qué carpetas están disponibles para este campo. Déjelo en blanco para mostrar todas las carpetas.',
        'warning'      => 'Los permisos de carpeta existentes tienen prioridad sobre las carpetas seleccionadas.',
    ],
    'min'     => [
        'label'        => 'Selecciones mínimas',
        'instructions' => 'Ingrese el número mínimo de selecciones permitidas.',
    ],
    'max'     => [
        'label'        => 'Selecciones máximas',
        'instructions' => 'Ingrese el número máximo de selecciones permitidas.',
    ],
    'mode'    => [
        'name'         => 'Modo de entrada',
        'instructions' => '¿Cómo deben proporcionar los usuarios la entrada de archivos?',
        'option'       => [
            'default' => 'Cargar y / o seleccionar archivos.',
            'select'  => 'Seleccionar solo archivos.',
            'upload'  => 'Subir solo archivos.',
        ],
    ],
];
