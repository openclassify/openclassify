<?php

return [
    'folders' => [
        'name'         => 'Carpetes',
        'instructions' => 'Especifiqueu les carpetes disponibles per a aquest camp. Deixeu-ho en blanc per mostrar totes les carpetes.',
        'warning'      => 'Els permisos de carpeta existents tenen prioritat sobre les carpetes seleccionades.',
    ],
    'max'     => [
        'name'         => 'Mida màxima de pujada',
        'instructions' => 'Especifiqueu la mida màxima de càrrega en <strong>megabytes</strong>.',
        'warning'      => 'Si no s\'especifica, s\'utilitzarà la carpeta màx i el servidor màxim.',
    ],
    'mode'    => [
        'name'         => 'Mode d’entrada',
        'instructions' => 'Com han de proporcionar els usuaris l\'entrada de fitxers?',
        'option'       => [
            'default' => 'Pengeu i / o seleccioneu fitxers.',
            'select'  => 'Seleccioneu només fitxers.',
            'upload'  => 'Pengeu només fitxers.',
        ],
    ],
];
