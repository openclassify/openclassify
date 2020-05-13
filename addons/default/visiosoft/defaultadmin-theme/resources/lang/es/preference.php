<?php

return [
    'sidebar_hover' => [
        'name'         => 'Desplazamiento de la barra lateral',
        'instructions' => '¿Expandir la barra lateral al pasar el mouse?',
    ],
    'navigation'    => [
        'name'         => 'Navegación',
        'instructions' => 'Especifique su orden de navegación <em>personal</em>.',
        'warning'      => 'El primer elemento de navegación accesible se usa como su área de <strong>inicio</strong>.',
        'reorder'      => 'Arrastre y suelte los elementos de navegación principales en la barra lateral <strong></strong> para reordenarlos.',
    ],
    'display'       => [
        'name'         => 'Densidad de pantalla',
        'instructions' => 'La pantalla compacta permite mostrar más contenido en la pantalla a la vez.',
        'option'       => [
            'default' => 'Defecto',
            'compact' => 'Compacto',
        ],
    ],
    'sidebars'      => [
        'name'         => 'Modo de barra lateral',
        'instructions' => 'Las barras laterales estáticas siempre estarán visibles.',
        'option'       => [
            'default' => 'Defecto',
            'static'  => 'Estático',
        ],
    ],
];
