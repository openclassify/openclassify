<?php

return [
    'mode'        => [
        'label'        => 'Tipo di input',
        'instructions' => 'Vuoi mostrare gli input per una data, un orario o entrambi?',
        'datetime'     => 'Data + Orario',
        'date'         => 'Data',
        'time'         => 'Orario',
    ],
    'picker'      => [
        'label'        => 'Date Picker',
        'instructions' => 'Vuoi mostrare un date/time picker?',
        'warning'      => 'Se disabilitato verrà mostrata una maschera base.',
    ],
    'date_format' => [
        'label'        => 'Formato data',
        'instructions' => 'Seleziona il formato data dell\'input.',
    ],
    'time_format' => [
        'label'        => 'Formato orario',
        'instructions' => 'Seleziona il formato orario per l\'input.',
    ],
    'timezone'    => [
        'label'        => 'Timezone',
        'instructions' => 'Seleziona la Timezone.',
        'placeholder'  => 'Timezone di default',
    ],
    'step'        => [
        'label'        => 'Minuto',
        'instructions' => 'Seleziona l\'intervallo di minuti.',
    ],
];
