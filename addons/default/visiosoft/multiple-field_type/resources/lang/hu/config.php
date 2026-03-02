<?php

return [
    'related'    => [
        'label'        => 'Releváns Folyam',
        'instructions' => 'Határozd meg a releváns folyamat a legördülő megjelenítéséhez.',
    ],
    'mode'       => [
        'label'  => 'Bevitel Módja',
        'option' => [
            'tags'       => 'Cimkék',
            'lookup'     => 'Átvizsgálás',
            'checkboxes' => 'Jelölőnégyzetek',
        ],
    ],
    'min'        => [
        'label'        => 'Minimális Kiválasztás',
        'instructions' => 'Határozd meg a minimálisan kiválasztható elemek számát.',
    ],
    'max'        => [
        'label'        => 'Maximális Kiválasztás',
        'instructions' => 'Határozd meg a maximálisan kiválasztható elemek számát.',
    ],
    'title_name' => [
        'label'        => 'Cím mező',
        'placeholder'  => 'keresztnév',
        'instructions' => 'Adja meg a <strong></strong> mezõjét a megjelenítendõ legördülõ / keresési opciókhoz.<br>Megadhat értelmezhető címeket, például <strong>{entry.first_name} {entry.last_name}</strong><br>Alapértelmezés szerint a kapcsolódó adatfolyam oszlopát fogja használni.',
    ],
];
