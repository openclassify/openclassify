<?php

return [
    'type' => [
        'label'    => 'Kiegészítő Típus',
    'instructions' => 'Milyen típusú kiegészítőt szeretnél használni?',
    'placeholder'  => 'Minden Típus',
    ],
    'search' => [
        'label'    => 'Keresés Kiegészítők',
    'instructions' => 'Ha a Kiterjesztés; kiegészítő típust választod definiálhatsz opcionális keresési paramétert itt, hogy a kiegészítő a specifikus szolgáltatást nyújtsa.',
    'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'    => 'Téma Típusa',
    'instructions' => 'Ha a Téma kiegészítő típust választod beállíthatod, hogy csak az admin felületre, vagy csak a publikus felületre limitáljuk a témákat.',
    'placeholder'  => 'Admin + Publikus',
    'admin'        => 'Admin',
    'public'       => 'Publikus',
    ],
];