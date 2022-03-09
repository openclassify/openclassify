<?php

return [
    'title' => [
        'name'     => 'Cím',
    'instructions' => 'Határozz meg egy rövid leíró nevet az oldalhoz.',
    ],
    'slug' => [
        'name'     => 'Azonosító',
    'instructions' => [
        'types' => 'Az azonosítót használjuk az adatbázis tábla létrehozásához a típus oldalaihoz.',
    'pages'     => 'Az azonosítót az oldal URL generálásához használljuk.',
    ],
    ],
    'meta_title' => [
        'name'     => 'Meta Title',
    'instructions' => 'Határozz megy egy SEO címet.',
    'warning'      => 'Az oldal címet használjuk alapértelmezetten.',
    ],
    'meta_description' => [
        'name'     => 'Meta Description',
    'instructions' => 'Határozz meg egy SEO description-t.',
    ],
    'name' => [
        'name'     => 'Név',
    'instructions' => 'Határozz meg egy rövid leíró mebet az oldal típusnak.',
    ],
    'description' => [
        'name'     => 'Leírás',
    'instructions' => 'Röviden mutasd be az oldal típust.',
    ],
    'theme_layout' => [
        'name'     => 'Téma Elrendezés',
    'instructions' => 'Határozd meg a téme elrendezését, ami magába foglalja az oldal elrendezését.',
    ],
    'layout' => [
        'name'     => 'Oldal Elrendezés',
    'instructions' => 'Az elrendezést használjuk az oldal tartalmának megjelenítéséhez.',
    ],
    'allowed_roles' => [
        'name'     => 'Engedélyezett Szerepek',
    'instructions' => 'Határoz meg  mely felhasználói szerepek érik el az oldalt.',
    'warning'      => 'Ha nem határozol meg szerepet mindenki elérheti az oldalt.',
    ],
    'visible' => [
        'name'     => 'Látható',
    'label'        => 'Megjelenítsük az oldalt a főmenüben?',
    'instructions' => 'Tiltsd le, ha nem szeretnéd, hogy az oldal megjelenjen a menüben.',
    'warning'      => 'Az oldal felépítésének függvényében nem minden esetben van hatással a weboldalra.',
    ],
    'exact' => [
        'name'     => 'Pontos URI',
    'label'        => 'Pontos URI kell az oldal eléréséhez?',
    'instructions' => 'Tiltsd le, ha egyedi paramétereket szeretnél átadni az oldalnak.',
    ],
    'enabled' => [
        'name'     => 'Engedélyezett',
    'label'        => 'Az oldal engedélyezett?',
    'instructions' => 'Ha letiltod az előnézet gombbal még mindíg eléred az oldalt az adminisztrációs felületből.',
    'warning'      => 'Az oldalt engedélyezned kell, hogy publikusan látható legyen.',
    ],
    'home' => [
        'name'     => 'Kezdőoldal',
    'label'        => 'Legyen ez a kezdőoldal?',
    'instructions' => 'A kezdőoldal az az oldal amire a látogatóid először érkeznek meg.',
    ],
    'parent' => [
        'name' => 'Szülő',
    ],
    'handler' => [
        'name'     => 'Kezelő',
    'instructions' => 'Az oldal kezelője felelős a teles HTTP válasz feldolgozásáért.',
    ],
    'content' => [
        'name' => 'Tartalom',
    ],
];
