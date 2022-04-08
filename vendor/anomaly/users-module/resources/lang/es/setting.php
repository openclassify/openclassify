<?php

return [
    'allow_registration' => [
        'label'        => 'Permitir registro.',
        'instructions' => 'Permitir que los usuarios se registren en el sitio web?',
        'text'         => 'Si, Permitir que se registren usuarios',
    ],
    'activation_mode'    => [
        'label'        => 'Modo de activación',
        'instructions' => 'Como se deben activar los usuarios despues del registro?',
        'option'       => [
            'manual'    => 'El administrador los activa manualmente.',
            'email'     => 'Enviar email de activación al usuario.',
            'automatic' => 'Activar el usuario automaticamente.',
        ],
    ],
    'profile_visibility' => [
        'label'        => 'Visualización del perfil',
        'instructions' => 'Especificar quien puede ver el perfil del usuario en el sitio público.',
        'option'       => [
            'everyone' => 'Cualquiera puede ver el perfil.',
            'owner'    => 'Solo el dueño del perfil puede verlo.',
            'disabled' => 'Desabilitar esta funcionalidad.',
            'users'    => 'Cualquier usuario autenticado puede ver el perfil de otro.',
        ],
    ],
];