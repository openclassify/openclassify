<?php

return [
    'name' => [
        'name'     => 'Név',
    'instructions' => 'Határozz meg egy rövid leíró nevet a vezérlőpultnak.',
    ],
    'title' => [
        'name'     => 'Cím',
    'instructions' => 'Határozz meg egy rövid leíró címet a minialkalmazáshoz.',
    ],
    'slug' => [
        'name'     => 'Slug',
    'instructions' => 'A slugot a vezérlőpult URL-jéhez használjuk.',
    ],
    'description' => [
        'name'     => 'Leírás',
    'instructions' => [
        'dashboards' => 'Mutasd be röviden a vezérlőpultot.',
    'widgets'        => 'Mutasd be röviden a minialkalmazást.',
    ],
    ],
    'layout' => [
        'name'     => 'Elrendezés',
    'instructions' => 'Az elrendezés határozza meg a vezérlőpulton a minialkalmazások helyzetét.',
    'option'       => [
        '24'  => 'Egy cella',
    '12-12'   => 'Két egyforma cella',
    '16-8'    => 'Két cella - bal hangsúlyosabb',
    '8-16'    => 'Két cella - jobb hangsúlyosabb',
    '8-8-8'   => 'Három egyforma cella',
    '6-12-6'  => 'Három cella - középső hangsúlyosabb',
    '12-6-6'  => 'Három cella - bal hangsúlyosabb',
    '6-6-12'  => 'Három cella - jobb hangsúlyosabb',
    '6-6-6-6' => 'Négy egyforma cella',
    ],
    ],
    'dashboard' => [
        'name'     => 'Vezérlőpult',
    'instructions' => 'Válaszd ki, hogy a minialkalmazás melyik vezérlőpulthoz tartozik.',
    ],
    'extension' => [
        'name' => 'Kiterjesztés',
    ],
    'pinned' => [
        'name'     => 'Kitűzve',
    'label'        => 'Kitűzöd a minialkalmazást?',
    'instructions' => 'A kitűzött minialkalmazások teljes szélességűek és a vezérlőpult tetején jelennek meg.',
    ],
    'allowed_roles' => [
        'name'     => 'Engedélyezett Szerepek',
    'instructions' => [
        'dashboards' => 'Határozd meg, hogy melyik felhasználói szerepek érik el a vezérlőpultot.',
    'widgets'        => 'Határozd meg, hogy melyik felhasználói szerepek látják a minialkalmazást.',
    ],
    'warning' => [
        'dashboards' => 'Ha nem határozol meg szerepet mindenki eléri ezt a vezérlőpultot.',
    'widgets'        => 'Ha nem határozol meg szerepet mindenki eléri ezt a vezérlőpultot.',
    ],
    ],
];