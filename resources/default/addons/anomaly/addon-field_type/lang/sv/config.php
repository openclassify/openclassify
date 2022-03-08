<?php

return [
    'type'       => [
        'label'        => 'Tilläggstyp',
        'instructions' => 'Vilken typ av tillägg vill du inkludera?',
        'placeholder'  => 'Alla Typer',
    ],
    'search'     => [
        'label'        => 'Sök Tillägg',
        'instructions' => 'Om tilläggsfälttypen är vald, kan du definiera en valfri sökparameter som ser till att endast tillägg som levererar en specifik tjänst visas.',
        'placeholder'  => 'anomaly.module.files::adapter.*',
    ],
    'theme_type' => [
        'label'        => 'Tematyp',
        'instructions' => 'Om tematillägget är valt, kan du lägga in en valfri begränsning för att endast visa antingen offentliga- eller adminteman.',
        'placeholder'  => 'Admin + Offentlig',
        'admin'        => 'Admin',
        'public'       => 'Offentlig',
    ],
];
