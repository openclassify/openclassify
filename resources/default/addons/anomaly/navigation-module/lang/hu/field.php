<?php

return [
    'name' => [
        'name'     => 'Név',
    'instructions' => [
        'menus' => 'Határozz meg egy rövid leíró nevet a menühöz.',
    ],
    ],
    'slug' => [
        'name'     => 'Azonosító',
    'instructions' => 'Az azonosítót a menü kijelzéséhez használjuk.',
    ],
    'description' => [
        'name'     => 'Leírás',
    'instructions' => 'Röviden mutasd be a navigációs menüt.',
    ],
    'target' => [
        'name'     => 'Cél',
    'instructions' => 'Hogyan nyíljon meg a link ha rákattintanak.',
    'option'       => [
        'self' => 'Aktuális ablakban megnyitás',
    'blank'    => 'Új ablakban megnyitás',
    ],
    ],
    'class' => [
        'name'     => 'Osztály',
    'instructions' => 'Határozz meg egyedi link osztályt a designhoz.',
    ],
    'allowed_roles' => [
        'name'     => 'Engedélyezett Szerepek',
    'instructions' => 'Határozd meg, hogy mely felhasználói szerepek láthatják a linket.',
    'warning'      => 'Ha nem határozol meg szerepet mindenki láthatja a linket.',
    ],
];