<?php

return [
    'folders' => [
        'name'         => 'Carpetas',
        'instructions' => 'Especifique qué carpetas están disponibles para este campo. Déjelo en blanco para mostrar todas las carpetas.',
        'warning'      => 'Los permisos de carpeta existentes tienen prioridad sobre las carpetas seleccionadas.',
    ],
    'max'     => [
        'name'         => 'Tamaño máximo de carga',
        'instructions' => 'Especifique el tamaño máximo de carga en <strong>megabytes</strong>.',
        'warning'      => 'Si no se especifica la carpeta max, se utilizará el servidor max.',
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
