<?php

return [
    'folders' => [
        'name'         => 'Mappák',
        'instructions' => 'Adja meg, mely mappák állnak rendelkezésre ehhez a mezőhöz. Az összes mappa megjelenítéséhez hagyja üresen.',
        'warning'      => 'A meglévő mappaengedélyek elsőbbséget élveznek a kiválasztott mappákkal szemben.',
    ],
    'max'     => [
        'name'         => 'Maximális feltöltési méret',
        'instructions' => 'Adja meg a maximális feltöltési méretet <strong>megabájtban</strong>.',
        'warning'      => 'Ha nincs megadva, akkor a max mappa, majd a server max lesz használva.',
    ],
    'mode'    => [
        'name'         => 'Bemeneti mód',
        'instructions' => 'Hogyan kell a felhasználóknak megadniuk a fájlbevitelt?',
        'option'       => [
            'default' => 'Fájlok feltöltése és / vagy kiválasztása.',
            'select'  => 'Csak fájlokat válasszon.',
            'upload'  => 'Csak fájlokat tölthet fel.',
        ],
    ],
];
