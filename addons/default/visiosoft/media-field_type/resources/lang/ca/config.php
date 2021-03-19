<?php

return [
    'folders' => [
        'name'         => 'Carpetes',
        'instructions' => 'Especifiqueu les carpetes disponibles per a aquest camp. Deixeu-ho en blanc per mostrar totes les carpetes.',
        'warning'      => 'Els permisos de carpeta existents tenen prioritat sobre les carpetes seleccionades.',
    ],
    'min'     => [
        'label'        => 'Seleccions mínimes',
        'instructions' => 'Introduïu el nombre mínim de seleccions permeses.',
    ],
    'max'     => [
        'label'        => 'Seleccions màximes',
        'instructions' => 'Introduïu el nombre màxim de seleccions permeses.',
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
