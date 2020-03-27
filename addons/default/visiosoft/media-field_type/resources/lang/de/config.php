<?php

return [
    'folders' => [
        'name'         => 'Ordner',
        'instructions' => 'Geben Sie an, welche Ordner für dieses Feld verfügbar sind. Lassen Sie das Feld leer, um alle Ordner anzuzeigen.',
        'warning'      => 'Bestehende Ordnerberechtigungen haben Vorrang vor ausgewählten Ordnern.',
    ],
    'min'     => [
        'label'        => 'Minimale Auswahl',
        'instructions' => 'Geben Sie die Mindestanzahl zulässiger Auswahlen ein.',
    ],
    'max'     => [
        'label'        => 'Maximale Auswahl',
        'instructions' => 'Geben Sie die maximal zulässige Auswahl ein.',
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
