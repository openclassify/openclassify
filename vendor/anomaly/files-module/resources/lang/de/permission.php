<?php

return [
    'files'   => [
        'name'   => 'Dateien',
        'option' => [
            'read'   => 'Darf auf Dateienbereich zugreifen?',
            'write'  => 'Darf Dateien hochladen und bearbeiten?',
            'delete' => 'Darf Dateien löschen?',
        ],
    ],
    'folders' => [
        'name'   => 'Ordner',
        'option' => [
            'read'   => 'Darf auf Ordnerbereich zugreifen?',
            'write'  => 'Darf Ordner erstellen und bearbeiten?',
            'delete' => 'Darf Ordner löschen?',
        ],
    ],
    'disks'   => [
        'name'   => 'Disks',
        'option' => [
            'read'   => 'Darf Disks ansehen?',
            'write'  => 'Darf Disks erstellen und bearbeiten?',
            'delete' => 'Darf Disks löschen?',
        ],
    ],
    'fields'  => [
        'name'   => 'Felder',
        'option' => [
            'manage' => 'Darf benutzerdefinierte Felder verwalten?',
        ],
    ],
];

