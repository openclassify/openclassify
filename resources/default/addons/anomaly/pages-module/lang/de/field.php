<?php

return [
    'title'                 => [
        'name'         => 'Titel',
        'instructions' => 'Was ist der Titel der Seite?',
    ],
    'slug'                  => [
        'name'         => 'Slug',
        'instructions' => 'Der &laquo;Slug&raquo; wird für den Aufbau der Seiten-URL benötigt.',
    ],
    'meta_title'            => [
        'name'         => 'Meta Titel',
        'instructions' => 'Geben Sie einen SEO-Titel für die Seite ein. Falls leer, wird der Titel der Seite verwendet.',
    ],
    'meta_description'      => [
        'name'         => 'Meta Beschreibung',
        'instructions' => 'Geben Sie die SEO-Beschreibung der Seite ein.',
    ],
    'ttl'                   => [
        'name'         => 'TTL',
        'label'        => 'Time to live (TTL)',
        'instructions' => 'Wie lange soll die Seite im Cache gehalten werden?',
    ],
    'css'                   => [
        'name'         => 'CSS',
        'instructions' => 'Dieser CSS-Code wird zur &laquo;<strong>styles.css</strong> asset collection&raquo; hinzugefügt.',
    ],
    'js'                    => [
        'name'         => 'JS',
        'instructions' => 'Dieses Script wird zur &laquo;<strong>scripts.js</strong> asset collection&rauqo; hinzugefügt.',
    ],
    'name'                  => [
        'name'         => 'Name',
        'instructions' => 'Was ist der Name dieses Seitentyps?',
    ],
    'description'           => [
        'name'         => 'Beschreibung',
        'instructions' => 'Bitte beschreiben Sie diesen Seitentyp.',
    ],
    'theme_layout'          => [
        'name'         => 'Theme Layout',
        'instructions' => 'Das &laquo;Theme Layout&raquo; umschliesst den Inhalt der Seiten.',
    ],
    'layout'                => [
        'name'         => 'Layout',
        'instructions' => 'Das Layout wird für die Darstellung des Seiteninhaltes benutzt.',
    ],
    'allowed_roles'         => [
        'name'         => 'Erlaubte Rollen',
        'instructions' => 'Welche Benutzerrollen dürfen diese Seite sehen?',
    ],
    'enabled'               => [
        'name'         => 'Enabled',
        'label'        => 'Ist diese Seite &laquo;enabled&raquo;?',
        'instructions' => 'Die Seite wird nur angezeigt, wenn sie &laquo;enabled&raquo; ist.',
    ],
    'home'                  => [
        'name'         => 'Homepage',
        'label'        => 'Ist das die Homepage?',
        'instructions' => 'Die Homepage ist die erste Seite, die beim Aufruf Ihrer Webadresse angezeigt wird.',
    ],
    'parent'                => [
        'name'         => 'Elternseite',
        'instructions' => 'Wählen Sie die Elternseite, falls es eine gibt.',
    ],
    'handler'               => [
        'name'         => 'Seiten-Handler',
        'instructions' => 'Wählen Sie den Seiten-Handler, der für den Aufbau des <em>HTTP response</em> einer Seite verantwortlich ist.',
    ],
    'route_suffix'          => [
        'name'         => 'Routen Suffix',
        'instructions' => 'Dieser Suffix wird an die Route angehängt, wenn die Routen-Datei aufgebaut wird.',
        'placeholder'  => '{slug}/{example}',
    ],
    'route_constraints'     => [
        'name'         => 'Route Einschränkungen',
        'instructions' => 'Geben Sie hier jede Routen-Parameter-Einschränkung als <em>YAML array</em> an. Beispiel: <code>parameter: constraint</code>.',
        'placeholder'  => 'slug: [A-Za-z]+',
    ],
    'additional_parameters' => [
        'name'         => 'Weitere Parameter',
        'instructions' => 'Geben Sie hier jeden weiteren Route-Parameter als <em>YAML array</em> an. Beispiel: <code>key: value</code>.',
        'placeholder'  => 'key: value',
    ],
];
