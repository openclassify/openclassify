<?php

return [
    'folders' => [
        'name'         => 'Ordner',
        'instructions' => 'Geben Sie an welche Ordner für dieses Feld verfügbar sind. Leer lassen um alle Ordner anzuzeigen.',
        'warning'      => 'Bestehende Ordnerberechtigungen haben Vorrang gegenüber den ausgewählten Ordnern.',
    ],
    'max'     => [
        'name'         => 'Maximale Upload Grösse',
        'instructions' => 'Geben Sie die maximal zulässige Dateigrösse in <strong>Megabyte</strong> an.',
        'warning'      => 'Wenn kein Wert angegeben wurde, wird der Maximalwert des Ordners und dann der des Servers verwendet.',
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
