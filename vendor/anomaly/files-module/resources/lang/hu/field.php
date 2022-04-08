<?php

return [
    'name'          => [
        'name'         => 'Név',
        'instructions' => [
            'disks'   => 'Adj meg egy rövid leíró nevet a lemeznek.',
            'folders' => 'Adj meg egy rövid leíró nevet a könyvtárnak.',
            'files'   => 'Adj nevet a fájlnak.',
        ],
    ],
    'title'         => [
        'name'         => 'Cím',
        'instructions' => 'Adj meg egy rövid leíró címet a fájlnak.',
    ],
    'slug'          => [
        'name'         => 'Azonosító',
        'instructions' => 'Az azonosítót használjuk a tárhely építéséhez.',
    ],
    'size'          => [
        'name' => 'Méret',
    ],
    'disk'          => [
        'name'         => 'Lemez',
        'instructions' => 'Válaszd ki, hogy melyik lemezhez tartozik a könyvtár.',
    ],
    'folder'        => [
        'name' => 'Könyvtár',
    ],
    'adapter'       => [
        'name' => 'Adapter',
    ],
    'keywords'      => [
        'name'         => 'Kulcsszavak',
        'instructions' => 'Határozz meg kulcsszavakat a fájlok rendezéséhez.',
    ],
    'mime_type'     => [
        'name' => 'MIME típus',
    ],
    'preview'       => [
        'name' => 'Előnézet',
    ],
    'description'   => [
        'name'         => 'Leírás',
        'instructions' => [
            'disks'  => 'Röviden mutasd be a lemezt.',
            'folder' => 'Röviden mutasd be a könyvtárat.',
            'files'  => 'Röviden mutasd be a fájlt.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'Engedélyezett típusok',
        'instructions' => 'Határozd meg a megengedett kiterjesztéseket ebben a könyvtárban.',
        'warning'      => 'Vedd figyelembe az eltérést a jpg és jpeg között.',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
];
