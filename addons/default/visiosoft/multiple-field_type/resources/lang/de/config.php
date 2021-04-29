<?php

return [
    'related'    => [
        'label'        => 'Verwandter Stream',
        'instructions' => 'Geben Sie die zugehörigen Stream-Einträge an, die in der Dropdown-Liste angezeigt werden sollen.',
    ],
    'mode'       => [
        'label'  => 'Eingabemodus',
        'option' => [
            'tags'       => 'Stichworte',
            'lookup'     => 'Nachschlagen',
            'checkboxes' => 'Kontrollkästchen',
        ],
    ],
    'min'        => [
        'label'        => 'Mindestanzahl',
        'instructions' => 'Geben Sie die Mindestanzahl zulässiger Auswahlen an.',
    ],
    'max'        => [
        'label'        => 'Maximalanzahl',
        'instructions' => 'Geben Sie die maximal zulässige Anzahl an Auswahlen an.',
    ],
    'title_name' => [
        'label'        => 'Titelfeld',
        'placeholder'  => 'Vorname',
        'instructions' => 'Geben Sie den <strong>Slug</strong> des Felds an, das für Dropdown- / Suchoptionen angezeigt werden soll.<br>Sie können analysierbare Titel wie <strong>{entry.first_name} {entry.last_name}</strong><br>angeben. Die Titelspalte des zugehörigen Streams wird standardmäßig verwendet.',
    ],
];
