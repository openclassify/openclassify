<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => [
            'menus' => 'Geben Sie einen kurzen beschreibenden Namen für dieses Menü an.',
        ],
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'Der Slug wird verwendet, wenn das Menü angezeigt wird.',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => 'Beschreiben Sie kurz dieses Navigationsmenü.',
    ],
    'target'        => [
        'name'         => 'Ziel',
        'instructions' => 'Wie öffnet sich dieser Link beim Anklicken?',
        'option'       => [
            'self'  => 'Im aktuellen Fenster öffnen.',
            'blank' => 'In einem neuen Fester öffnen.',
        ],
    ],
    'class'         => [
        'name'         => 'Klasse',
        'instructions' => 'Geben Sie zusätzliche Link-Klassen gemäß den Anweisungen Ihres Entwicklers an.',
    ],
    'allowed_roles' => [
        'name'         => 'Erlaubte Rollen',
        'instructions' => 'Geben Sie an, welche Benutzerrollen diesen Link sehen können.',
        'warning'      => 'Wenn keine Rollen angegeben sind, kann jeder diesen Link sehen.',
    ],
];
