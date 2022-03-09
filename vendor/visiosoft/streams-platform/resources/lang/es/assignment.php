<?php

return [
    'field'        => [
        'name'         => 'Campo',
        'label'        => 'Campo',
        'instructions' => 'Escoja el campo para asignar.'
    ],
    'label'        => [
        'name'         => 'Etiqueta',
        'instructions' => 'Las etiquetas solo para los formularios, si se dejan en blanco, se usará el nombre del campo.'
    ],
    'required'     => [
        'name'         => 'Requerido',
        'label'        => 'Es este campo requerido??',
        'instructions' => 'Si es requerido, el campo siempre debe tener un valor.'
    ],
    'unique'       => [
        'name'         => 'Único',
        'label'        => 'Es este campo único?',
        'instructions' => 'Si es único, el campo siempre debe tener un valor único.'
    ],
    'translatable' => [
        'name'  => 'Traducible',
        'label' => 'Es este campo traducible?'
    ],
    'instructions' => [
        'name'         => 'Instrucciones',
        'instructions' => 'Las instrucciones se mostrarán en el formulario para ayudar a los usuarios.'
    ]
];
