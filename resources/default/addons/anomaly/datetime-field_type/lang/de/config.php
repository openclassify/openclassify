<?php

return [
    'mode'        => [
        'label'        => 'Eingabemodus',
        'instructions' => 'Möchten Sie Eingabefelder für Datum, Zeit oder beides anzeigen?',
        'datetime'     => 'Datum + Zeit',
        'date'         => 'Datum',
        'time'         => 'Zeit',
    ],
    'date_format' => [
        'label'        => 'Datumsformat',
        'instructions' => 'Geben Sie das Format für die Eingabe des Datums an.',
    ],
    'time_format' => [
        'label'        => 'Zeitformat',
        'instructions' => 'Geben Sie das Format für die Eingabe der Zeit an.',
    ],
    'timezone'    => [
        'label'        => 'Zeitzone',
        'instructions' => 'Wählen Sie die Zeitzone für dieses Eingabefeld aus.', // @todo: check if contextual is neccessary
        'default'      => 'Standard Zeitzone',
        'user'         => 'Benutzer Zeitzone',
    ],
    'step'        => [
        'label'        => 'Minuten-Schritte',
        'instructions' => 'Wählen Sie die Minuten-Schritte für die Eingabe der Zeit aus.',
    ],
    'min'         => [
        'label'        => 'Minimum Datum',
        'instructions' => 'Geben Sie das minimal erlaubte Datum in Tagen, als Abstand vom Zeitpunkt der Eingabe, an.', // @todo: prbly needs clarification
        'placeholder'  => '-30',
    ],
    'max'         => [
        'label'        => 'Maximum Datum',
        'instructions' => 'Geben Sie das maximal erlaubte Datum in Tagen, als Abstand vom Zeitpunkt der Eingabe, an.', // @todo: prbly needs clarification
        'placeholder'  => '45',
    ],
];
