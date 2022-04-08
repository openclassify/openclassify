<?php

return [
    'name'           => [
        'label'        => 'Nombre del sitio',
        'instructions' => 'Cual es el nombre de su aplicación?',
        'placeholder'  => trans('distribution::addon.name')
    ],
    'description'    => [
        'label'        => 'Descripción del sitio',
        'instructions' => 'cual es el slogan o la descripción de la aplicación?',
        'placeholder'  => trans('distribution::addon.description')
    ],
    'date_format'    => [
        'label'        => 'Formato de fecha',
        'instructions' => 'Como se deben mostrar las fechas en el panel de control? Utilice los <a href="http://php.net/manual/en/function.date.php" target="_blank">formatos de fecha</a> de PHP.',
        'placeholder'  => 'm/d/Y'
    ],
    'time_format'    => [
        'label'        => 'Formato de hora',
        'instructions' => 'Como se deben mostrar las horas en el panel de control? Utilice los <a href="http://php.net/manual/en/function.date.php" target="_blank">formatos de hora</a> de PHP.',
        'placeholder'  => 'g:i A'
    ],
    'default_locale' => [
        'label'        => 'Idioma por defecto',
        'instructions' => 'Cual debe ser el idioma por defecto de la aplicación?<br>Los idiomas se pueden administrar en el módulo <a href="/admin/localization" target="_blank">Localización</a>.'
    ],
    'site_enabled'   => [
        'label'        => 'Sitio activado',
        'instructions' => 'Use esta opcion para desactivar o activar el sitio<br>Esto es útil cuando se desea hacer mantenimiento o desarrollo.'
    ],
    'ip_whitelist'   => [
        'label'        => 'IP Lista Blanca',
        'instructions' => 'Cuando el sitio este desactivado, estas IP podrán acceder a el.',
        'placeholder'  => 'Separe las IP con una coma (,).'
    ],
    '503_message'    => [
        'label'        => 'Mensaje para sitio desactivado',
        'instructions' => 'Cuando el sitio esta desactivado o hay un problema mayor, este mensaje se mostrará a los usuarios.',
        'placeholder'  => 'Ya regresamos!.'
    ],
    'force_https'    => [
        'label'        => 'Forzar HTTPS',
        'instructions' => 'Autorizar solo acceso a la aplicación solo con HTTPS?',
        'option'       => [
            'all'    => 'Obligar HTTPS a todas las conexiones',
            'none'   => 'No obligar conexiones HTTPS',
            'admin'  => 'Solo obligar conexiones HTTPS para acceder al panel de control',
            'public' => 'Solo obligar conexiones HTTPS para contenido público'
        ]
    ],
    'contact_email'  => [
        'label'        => 'Correo electrónico de contacto',
        'instructions' => 'Todos los correos electrónicos de los usuarios, llegarán a esta dirección por defecto.',
        'placeholder'  => 'example@domain.com'
    ],
    'server_email'   => [
        'label'        => 'Correo Electrónico del servidor',
        'instructions' => 'Todos los correos electrónicos del sistema saldrán de esta dirección.',
        'placeholder'  => 'noreply@domain.com'
    ],
    'mail_driver'    => [
        'label'        => 'Email Driver',
        'instructions' => 'Como envia correos la aplicación?',
        'option'       => [
            'smtp'     => 'SMTP',
            'mail'     => 'PHP Mail',
            'sendmail' => 'Sendmail',
            'mailgun'  => 'Mailgun',
            'mandrill' => 'Mandrill',
            'log'      => 'Log File'
        ]
    ],
    'mail_host'      => [
        'label'        => 'Host SMTP',
        'instructions' => 'Esta es la dirección del servidor SMTP de la aplicación.',
        'placeholder'  => 'smtp.mailgun.org'
    ],
    'mail_port'      => [
        'label'        => 'Puerto SMTP',
        'instructions' => 'Este es el puerto del servidor SMTP.',
        'placeholder'  => '587'
    ],
    'mail_username'  => [
        'label'        => 'Nombre de usuario SMTP',
        'instructions' => 'Este es el nombre de usuario del servidor SMTP.'
    ],
    'mail_password'  => [
        'label'        => 'Contraseña SMTP',
        'instructions' => 'Esta es la contraseña del servidor SMTP.'
    ],
    'mail_debug'     => [
        'label'        => 'Modo Depuración',
        'instructions' => 'Cuando esta opcion está activada, los correos electrónicos no se enviarán, se escribiran en el LOG de la aplicación.'
    ],
    'cache_driver'   => [
        'label'        => 'Driver de Cache',
        'instructions' => 'Como se guarda la información de cache?',
        'option'       => [
            'apc'       => 'APC',
            'array'     => 'Array',
            'file'      => 'File',
            'memcached' => 'Memcached',
            'redis'     => 'Redis'
        ]
    ],
    'standard_theme' => [
        'label'        => 'Plantilla pública',
        'instructions' => 'Que plantilla desea utilizar para el sitio?'
    ],
    'admin_theme'    => [
        'label'        => 'Plantilla de administración',
        'instructions' => 'Que plantilla desea usar para la administración del sitio?'
    ]
];
