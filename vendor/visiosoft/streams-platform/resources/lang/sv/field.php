<?php

return [
    'name'        => [
        'name'         => 'Namn',
        'instructions' => 'Vad är fältets namn?'
    ],
    'slug'        => [
        'name'         => 'Slug',
        'instructions' => 'Sluggen är, bland annat, använt för kolumnnamnet i databasen.'
    ],
    'description' => [
        'name'         => 'Beskrivning',
        'instructions' => 'Skriv en kortfattad beskrivning.'
    ],
    'type'        => [
        'name'         => 'Fälttyp',
        'instructions' => 'Vilken fälttyp vill du använda för detta fältet?'
    ],

    'placeholder'  => [
        'name'         => 'Platshållare',
        'instructions' => 'Om stöd finns syns platshållaren i ett input-fält när ingen inmatning har gjorts i fältet.',
    ],
    'title_column' => [
        'name'         => 'Kolumntitel',
        'instructions' => 'Specificera slug-fältet som används som titel?',
    ],
    'instructions' => [
        'name'         => 'Instruktioner',
        'instructions' => 'Fält instruktioner som visas i formulär för att hjälpa användare.',
    ],
    'warning'      => [
        'name'         => 'Varning',
        'instructions' => 'Varningar hjälper till att uppmärksamma viktig information.',
    ],
    'translatable' => [
        'name'         => 'Översättbara',
        'instructions' => 'Är inläggen i denna stream flerspråkiga?',
        'warning'      => 'Stream:en måste vara översättbara för att översättbara fält ska fungera ordentligt.',
    ],
    'trashable'    => [
        'name'         => 'Slängbara',
        'instructions' => 'Vill du slänga inläggen istället för att radera dem?',
    ],
    'sortable'     => [
        'name'         => 'Sorterbara',
        'instructions' => 'Är inläggen i denna stream manuellt sorterbara?',
    ],
    'searchable'   => [
        'name'         => 'Sökbara',
        'instructions' => 'Är inläggen i denna stream sökbara?',
    ],
    'config'       => [
        'name'         => 'Konfiguration',
        'instructions' => 'Ange valfria konfigurationsinställningar med JSON.',
    ],
];
