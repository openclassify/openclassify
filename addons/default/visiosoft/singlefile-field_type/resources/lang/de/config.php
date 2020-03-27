<?php

return [
    'folders' => [
        'name'         => 'Ordner',
        'instructions' => 'Geben Sie an, welche Ordner für dieses Feld verfügbar sind. Lassen Sie das Feld leer, um alle Ordner anzuzeigen.',
        'warning'      => 'Bestehende Ordnerberechtigungen haben Vorrang vor ausgewählten Ordnern.',
    ],
    'max'     => [
        'name'         => 'Maximale Upload-Größe',
        'instructions' => 'Geben Sie die maximale Upload-Größe in <strong>Megabyte</strong>.',
        'warning'      => 'Wenn nicht angegeben, werden stattdessen der Ordner max und dann der Server max verwendet.',
    ],
    'mode'    => [
        'name'         => 'Eingabemodus',
        'instructions' => 'Wie sollten Benutzer Dateieingaben bereitstellen?',
        'option'       => [
            'default' => 'Dateien hochladen und / oder auswählen.',
            'select'  => 'Nur Dateien auswählen.',
            'upload'  => 'Laden Sie nur Dateien hoch.',
        ],
    ],
];
