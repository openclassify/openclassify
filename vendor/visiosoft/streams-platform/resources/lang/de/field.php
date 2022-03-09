<?php

return [
    'name' => [
        'name'         => 'Name',
        'instructions' => 'Was ist der Name des Feldes?'
    ],
    'slug' => [
        'name'         => 'Slug',
        'instructions' => 'Der Slug wird, unter anderem, für den Spaltenname in der Datenbank benutzt.'
    ],
    'description'  => [
        'name'         => 'Beschreibung',
        'instructions' => 'Geben Sie eine kurze Beschreibung ein.',
    ],
    'type' => [
        'name'         => 'Feld-Typ',
        'instructions' => 'Welchen Feld-Typ möchten Sie für dieses Feld verwenden?',
        'warning'      => 'Wenn Sie diesen Wert ändern, wird diese Seite sofort neu geladen.',
    ],
    'placeholder'  => [
        'name'         => 'Platzhalter',
        'instructions' => 'Wenn dies unterstützt wird, werden Platzhalter im Eingabefeld angezeigt, wenn keine Eingabe gemacht wurde.',
    ],
    'title_column' => [
        'name'         => 'Titel Spalte',
        'instructions' => 'Specify the field slug that acts as a title?',
    ],
    'instructions' => [
        'name'         => 'Anweisungen',
        'instructions' => 'Anweisungen für dieses Feld werden anzeigt, um den Benutzer beim Ausfüllen des Formulares zu helfen.'
    ],
    'warning'      => [
        'name'         => 'Warnung',
        'instructions' => 'Warnungen weisen auf wichtige Informationen hin.',
    ],
    'translatable' => [
        'name'         => 'Übersetzbar',
        'instructions' => 'Wenn dieses Feld übersetzbar ist, wird in allen aktivierten Sprachen verfügbar sein.',
        'warning'      => 'Der Stream muss übersetzbar sein, damit übersetzbare Felder korrekt funktionieren.',
    ],
    'trashable'    => [
        'name'         => 'Papierkorb',
        'instructions' => 'Einträge beim Löschen zunächst in den Papierkorb legen?',
    ],
    'sortable'     => [
        'name'         => 'Sortierbar',
        'instructions' => 'Sind die Einträge dieses Streams sortierbar?',
    ],
    'searchable'   => [
        'name'         => 'Durchsuchbar',
        'instructions' => 'Sind die Einträge dieses Streams durchsuchbar?',
    ],
    'config'       => [
        'name'         => 'Konfiguration',
        'instructions' => 'Geben Sie eine optionale Konfiguration im JSON Format an.',
    ],
];
