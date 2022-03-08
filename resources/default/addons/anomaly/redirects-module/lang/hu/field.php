<?php

return [
    'from' => [
        'name'     => 'Forrás',
    'label'        => 'Átirányít Forrás',
    'placeholder'  => '/foo/bar/{var}',
    'instructions' => 'Határozz meg egy pontos útvonalat vagy mintát az átirányítás forrásának. Pl. foo/bat/{var} vagy foo/bar vagy http://{account}.regi.com/{path}',
    ],
    'to' => [
        'name'     => 'Cél',
    'label'        => 'Átirányítás Célja',
    'placeholder'  => 'bar/{var}',
    'instructions' => 'Határozz meg egy pontos útvonalat vagy mintát az átirányítás céljának Pl. foo/bat/{var} vagy foo/bar vagy http://{account}.regi.com/{path}',
    ],
    'status' => [
        'name'     => 'Státusz',
    'instructions' => 'Milyen típusú átirányítás ez?',
    'option'       => [
        '301' => '301 - Állandó Átirányítás',
    '302'     => '302 - Ideiglenes Átirányítás',
    ],
    ],
    'secure' => [
        'name'     => 'Biztonság',
    'label'        => 'Biztonságos URL-re irányítód?',
    'instructions' => 'Forszírozod a biztonságos kapcsolatot az átirányításnál?',
    'warning'      => 'Ha az átirányítás értékének beállítasz egy protokolt a rendszer nem veszi figyelembe az opciót.',
    ],
];