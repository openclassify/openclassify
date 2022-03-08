<?php

return [
    'title'            => [
        'name'         => 'Título',
        'placeholder'  => 'Hello World!',
        'instructions' => 'Cual es el título de la página?',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'placeholder'  => 'hello-world',
        'instructions' => 'El Slug es utilizado para construir la URL de la página',
    ],
    'meta_title'       => [
        'name'         => 'Meta Título',
        'placeholder'  => 'Hello World!',
        'instructions' => 'Ingrese el Título SEO de la página, por defecto se usará el título de la página.',
    ],
    'meta_description' => [
        'name'         => 'Meta descripción',
        'placeholder'  => 'Bienvenidos a nuestro sitio!',
        'instructions' => 'Ingrese la descripción para SEO de la página.',
    ],
    'ttl'              => [
        'name'         => 'TTL',
        'label'        => 'Tiempo de Vida (TTL)',
        'instructions' => '¿Por cuánto tiempo (en segundos) quiere almacenar en caché la página antes de servir el contenido actualizado? El valor de configuración se utiliza por defecto.',
    ],
    'css'              => [
        'name'         => 'CSS',
        'instructions' => 'Los archivos CSS se analizan al cargar así que sientase libre de usar la configuración de la plantilla y otras etiquetas.',
    ],
    'js'               => [
        'name'         => 'JS',
        'instructions' => 'Los archivos JS se analizan al cargar así que sientase libre de usar la configuración de la plantilla y otras etiquetas.',
    ],
    'name'             => [
        'name'         => 'Nombre',
        'instructions' => 'Cual es el nombre del tipo de página?',
    ],
    'description'      => [
        'name'         => 'Descripción',
        'instructions' => 'Describa du tipo de página.',
    ],
    'theme_layout'     => [
        'name'         => 'Plantilla',
        'instructions' => 'La plantilla se utilizará para encerrar el contenido de la página.',
    ],
    'layout'           => [
        'name'         => 'Disposición',
        'instructions' => 'La disposición gráfica será utilizada para mostrar el contenido de la página.',
    ],
    'allowed_roles'    => [
        'name'         => 'Roles autorizados',
        'instructions' => 'Que roles de usuario estan autorizados a ver esta página?',
    ],
    'enabled'          => [
        'name'         => 'Activa',
        'label'        => 'Esta esta página activa?',
        'instructions' => 'Solo las paginas activas se mostrarán.',
    ],
    'parent'           => [
        'name'         => 'Padre',
        'instructions' => 'Seleccione la página padre si existe.',
    ],
];
