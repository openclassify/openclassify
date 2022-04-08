<?php

return [
    'related'    => [
        'label'        => 'Verbundener Stream',
        'instructions' => 'Geben Sie den verbunden Stream an, dessen Einträge im Dropdown zur Auswahl stehen sollen.',
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
        'label'        => 'Minimalauswahl',
        'instructions' => 'Geben Sie die minimale Anzahl an auszuwählenden Einträgen ein.',
    ],
    'max'        => [
        'label'        => 'Maximalauswahl',
        'instructions' => 'Geben Sie die maximal erlaubte Anzahl an ausgewählten Einträgen an.',
    ],
    'title_name' => [
        'label'        => 'Titelfeld',
        'placeholder'  => 'Vorname',
        'instructions' => 'Geben Sie den <strong>Slug</strong> des Felds an, das für Dropdown- / Suchoptionen angezeigt werden soll.<br>Sie können analysierbare Titel wie <strong>{entry.first_name} {entry.last_name}</strong><br>angeben. Die Titelspalte des zugehörigen Streams wird standardmäßig verwendet.',
    ],
];
