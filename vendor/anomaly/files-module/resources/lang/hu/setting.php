<?php

return [
    'max_upload_size'      => [
        'name'         => 'Maximális Feltöltési Méret',
        'instructions' => 'Határozd meg a maximális fájl méretet a feltöltéshez.',
        'warning'      => 'A szerver maximális feltöltési mérete jelenleg ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maximális párhuzamos feltöltések',
        'instructions' => 'Határozd meg a párhuzamosan futó feltöltések maximális számát.',
    ],
];
