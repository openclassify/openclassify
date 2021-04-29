<?php

return [
    'related'    => [
        'label'        => 'Kapcsolódó adatfolyam',
        'instructions' => 'Adja meg a legördülő menüben megjelenítendő kapcsolódó adatfolyamokat.',
    ],
    'mode'       => [
        'label'  => 'Bemeneti mód',
        'option' => [
            'tags'       => 'Címkék',
            'lookup'     => 'Nézz fel',
            'checkboxes' => 'Jelölőnégyzetek',
        ],
    ],
    'min'        => [
        'label'        => 'Minimális választások',
        'instructions' => 'Adja meg a megengedett kiválasztások minimális számát.',
    ],
    'max'        => [
        'label'        => 'Maximális választási lehetőségek',
        'instructions' => 'Adja meg a megengedett kiválasztások maximális számát.',
    ],
    'title_name' => [
        'label'        => 'Cím mező',
        'placeholder'  => 'keresztnév',
        'instructions' => 'Adja meg a <strong></strong> mezõjét a megjelenítendõ legördülõ / keresési opciókhoz.<br>Megadhat értelmezhető címeket, például <strong>{entry.first_name} {entry.last_name}</strong><br>Alapértelmezés szerint a kapcsolódó adatfolyam oszlopát fogja használni.',
    ],
];
