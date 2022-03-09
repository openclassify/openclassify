<?php

return [
    'field'        => [
        'name'         => 'Feld',
        'label'        => 'Feld',
        'instructions' => 'Wählen Sie das Feld, welches hinzugefügt werden soll.'
    ],
    'label'        => [
        'name'         => 'Beschriftung',
        'instructions' => 'Beschriftungen werden nur in Formularen benutzt. Wenn die Beschriftung leer ist, wird der Feldname verwendet.'
    ],
    'required'     => [
        'name'         => 'Erforderlich',
        'label'        => 'Ist dieses Feld erforderlich?',
        'instructions' => 'Falls dieses Feld erforderlich ist, muss es zwingend ausgefüllt werden.'
    ],
    'unique'       => [
        'name'         => 'Eindeutig',
        'label'        => 'Ist dieses Feld eindeutig?',
        'instructions' => 'Wenn dieses Feld eindeutig ist, muss ein eindeutiger Wert eingegeben werden.'
    ],
    'searchable'   => [
        'name'         => 'Durchsuchbar',
        'label'        => 'Ist dieses Feld durchsuchbar?',
        'instructions' => 'Nur durchsuchbare Felder werden indiziert.',
    ],
    'placeholder'  => [
        'name'         => 'Platzhalter',
        'instructions' => 'Falls unterstützt, wird dieser Platzhalter angezeigt, solange kein Wert eingegeben wurde.'
    ],
    'translatable' => [
        'name'         => 'Übersetzbar',
        'label'        => 'Ist dieses Feld übersetzbar?',
        'instructions' => 'Wenn dieses Feld übersetzbar ist, wird in allen aktivierten Sprachen verfügbar sein.',
        'warning'      => [
            'column_type' => 'Der zugehörige Feldtyp unterstützt keine übersetzbaren Werte.',
            'stream'      => 'Der zugehörige Stream ist nicht übersetzbar.',
        ],
    ],
    'instructions' => [
        'name'         => 'Anweisungen',
        'instructions' => 'Anweisungen für dieses Feld werden anzeigt, um den Benutzer beim Ausfüllen des Formulares zu helfen.'
    ],
    'warning'      => [
        'name'         => 'Warnung',
        'instructions' => 'Warnungen weisen auf wichtige Informationen hin.',
    ],
];
