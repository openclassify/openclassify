<?php

return [
    'folders' => [
        'name'         => 'Mappák',
        'instructions' => 'Adja meg, mely mappák állnak rendelkezésre ehhez a mezőhöz. Az összes mappa megjelenítéséhez hagyja üresen.',
        'warning'      => 'A meglévő mappaengedélyek elsőbbséget élveznek a kiválasztott mappákkal szemben.',
    ],
    'min'     => [
        'label'        => 'Minimális választások',
        'instructions' => 'Adja meg a megengedett kiválasztások minimális számát.',
    ],
    'max'     => [
        'label'        => 'Maximális választási lehetőségek',
        'instructions' => 'Adja meg a megengedett kiválasztások maximális számát.',
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
