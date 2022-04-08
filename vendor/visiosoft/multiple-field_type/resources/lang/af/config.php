<?php

return [
    'related'    => [
        'label'        => 'Verwante stroom',
        'instructions' => 'Spesifiseer die verwante stroominskrywings wat in die keuselys vertoon moet word.',
    ],
    'mode'       => [
        'label'  => 'Invoermodus',
        'option' => [
            'tags'       => 'Merkers',
            'lookup'     => 'Soek',
            'checkboxes' => 'Merkblokkies',
        ],
    ],
    'min'        => [
        'label'        => 'Minimum keuses',
        'instructions' => 'Spesifiseer die minimum aantal toegelate keuses.',
    ],
    'max'        => [
        'label'        => 'Maksimum keuses',
        'instructions' => 'Spesifiseer die maksimum aantal toegelate keuses.',
    ],
    'title_name' => [
        'label'        => 'Titelveld',
        'placeholder'  => 'eerste naam',
        'instructions' => 'Spesifiseer die <strong>slak</strong> van die veld om te vertoon vir die keuselys / soekopsies.<br>U kan ontleedbare titels spesifiseer soos <strong>{entry.first_name} {entry.last_name}</strong><br>Die titelkolom van die verwante stroom sal standaard gebruik word.',
    ],
];
