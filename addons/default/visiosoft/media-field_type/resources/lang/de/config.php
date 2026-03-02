<?php

return [
    'folders' => [
        'name'         => 'Ordner',
        'instructions' => 'Geben Sie an welche Ordner für dieses Feld verfügbar sind. Leer lassen um alle Ordner anzuzeigen.',
        'warning'      => 'Bestehende Ordnerberechtigungen haben Vorrang gegenüber den ausgewählten Ordnern.',
    ],
    'min'     => [
        'label'        => 'Mindestanzahl',
        'instructions' => 'Geben Sie die erlaubte Mindestanzahl an ausgewählten Dateien ein.',
    ],
    'max'     => [
        'label'        => 'Maximalanzahl',
        'instructions' => 'Geben Sie die erlaubte Maximalanzahl an ausgewählten Dateien an.',
    ],
    'mode'    => [
        'name'         => 'Eingabemodus',
        'instructions' => 'Wie sollen Benutzer Dateien bereitstellen können?',
        'option'       => [
            'default' => 'Upload und/oder Dateiauswahl.',
            'select'  => 'Nur Dateiauswahl.',
            'upload'  => 'Nur Upload.',
        ],
    ],
];
