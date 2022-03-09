<?php

return [
    'name' => [
        'name'     => 'Név',
    'instructions' => [
        'types'  => 'Adj meg egy rövid leíró nevet a hír típusnak.',
    'categories' => 'Adj meg egy rövid leíró nevet a kategóriának.',
    ],
    ],
    'title' => [
        'name'     => 'Cím',
    'instructions' => 'Adj meg egy rövid leíró címet a hírnek.',
    ],
    'slug' => [
        'name'     => 'Azonosító',
    'instructions' => [
        'types'  => 'Az azonosítót az adatbázis tábla kezeléséhez használljuk.',
    'categories' => 'Az azonosítót a kategória URL létrehozásához használjuk.',
    'posts'      => 'Az azonosítót a hír URL  létrehozásához használjuk.',
    ],
    ],
    'description' => [
        'name'     => 'Leírás',
    'instructions' => [
        'types'  => 'Adj rövid leírást a hír típushoz.',
    'categories' => 'Adj rövid leírást a kategóriához.',
    ],
    'warning' => 'A weboldal felépítésétől függően lehetséges, hogy a beállítás ellenére megjelenik/nem jelenik meg publikusan.',
    ],
    'summary' => [
        'name'     => 'Összefoglalás',
    'instructions' => 'Írj rövid összefoglalást a hírhez.',
    ],
    'category' => [
        'name'     => 'Kategória',
    'instructions' => 'Válaszd ki, hogy a hír melyik kategóriába tartozik.',
    ],
    'meta_title' => [
        'name' => 'Meta Title
',
    'instructions' => 'Határozz meg egy SEO címet.',
    'warning'      => 'A hír címét használjuk alapértelmezetten.',
    ],
    'meta_description' => [
        'name'     => 'Meta Description',
    'instructions' => 'Határozz meg egy SEO leírást.',
    ],
    'theme_layout' => [
        'name'     => 'Téma Elrendezés',
    'instructions' => 'Határozd meg a téma elrendezését ami tartalmazni fogja a hír elrendezését.',
    ],
    'layout' => [
        'name'     => 'Hír Elrendezés',
    'instructions' => 'Az elrendezést használjuk a Hír tartalmának megjelenítéséhez.',
    ],
    'tags' => [
        'name'     => 'Cimkék',
    'instructions' => 'Határozz meg cimkéket a hírek csoportosításához.',
    ],
    'enabled' => [
        'name'     => 'Engedélyezett',
    'label'        => 'A hír engedélyezett?',
    'instructions' => 'Ha letiltod a hír még elérhető marad az előnézet gombbal az adminisztrációs felületen.',
    'warning'      => 'A hírt engedélyezned kell, hogy publikusan megjelenjen.',
    ],
    'featured' => [
        'name'     => 'Kiemelt',
    'label'        => 'A hír kiemelt?',
    'instructions' => 'A kiemelt híreket használhatod a nagyobb figyelemfelkeltésre.',
    'warning'      => 'A weboldal felépítésétől függően nem biztos, hogy ennek van hatása az oldalra.',
    ],
    'publish_at' => [
        'name'     => 'Megjelenés Dátuma/Ideje',
    'instructions' => 'Határozd meg a megjelenés Dátumát/Idejét.',
    'warning'      => 'Ha a jövőre állítod a hír nem jelenik meg a megadott időpontig.',
    ],
    'author' => [
        'name'     => 'Szerző',
    'instructions' => 'Határozd meg a Hír szerzőjét.',
    ],
    'status' => [
        'name' => 'Státusz',
    'option'   => [
        'live'  => 'Élő',
    'draft'     => 'Piszkozat',
    'scheduled' => 'Időzített',
    ],
    ],
    'content' => [
        'name' => 'Tartalom',
    ],
];
