<?php

return [
    'name'         => [
        'name'         => 'Nombre',
        'instructions' => 'Cual es el nombre del rol?',
        'placeholder'  => 'Editor',
    ],
    'first_name'   => [
        'name'         => 'Nombre',
        'instructions' => 'Cual es el nombre del usuario?',
        'placeholder'  => 'John',
    ],
    'last_name'    => [
        'name'         => 'Apellido',
        'instructions' => 'Cual es el apellido del usuario?',
        'placeholder'  => 'Doe',
    ],
    'display_name' => [
        'name'         => 'Nombre para mostrar',
        'instructions' => 'Cual es el nombre para mostrar del usuario? si no se coloca se usara el nombre del usuario.',
        'placeholder'  => 'Mr. John Doe',
    ],
    'username'     => [
        'name'         => 'Nombre de usuario.',
        'instructions' => 'Cual es el nombre de usuario? debe ser único entre todos los usuarios.',
        'placeholder'  => 'johndoe1',
    ],
    'email'        => [
        'name'         => 'Correo Electrónico',
        'instructions' => 'Cual es el correo electrónico del usuario? debe ser único entre todos los usuarios.',
        'placeholder'  => 'example@domain.com',
    ],
    'password'     => [
        'name'         => 'Contraseña',
        'instructions' => 'Ingrese una contraseña para el usuario.',
    ],
    'slug'         => [
        'name'         => 'Slug',
        'instructions' => 'Ingrese el Slug del role, internamente se utiliza y debe ser único entre todos los roles.',
        'placeholder'  => 'editor',
    ],
    'roles'        => [
        'name'         => 'Roles',
        'count'        => ':count rol(s)',
        'instructions' => 'Escoja los roles para asignarle al usuario.',
    ],
    'permissions'  => [
        'name'  => 'Permisos',
        'count' => ':count permiso(s)',
    ],
    'activated'    => [
        'name'          => 'Activado',
        'activated'     => 'Activado',
        'not_activated' => 'No activado',
    ],
    'blocked'      => [
        'name'    => 'Bloqueado',
        'blocked' => 'Bloqueado',
    ],
    'website'      => [
        'name' => 'Website',
    ],
];
