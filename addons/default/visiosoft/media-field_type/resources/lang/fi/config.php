<?php

return [
    'folders' => [
        'name'         => 'Kansiot',
        'instructions' => 'Määritä, mitkä kansiot ovat käytettävissä tässä kentässä. Jätä tyhjä nähdäksesi kaikki kansiot.',
        'warning'      => 'Olemassa olevat kansioiden käyttöoikeudet ovat etusijalla valittuihin kansioihin nähden.',
    ],
    'min'     => [
        'label'        => 'Vähimmäisvalinnat',
        'instructions' => 'Anna sallittujen valintojen vähimmäismäärä.',
    ],
    'max'     => [
        'label'        => 'Suurin valikoima',
        'instructions' => 'Syötä sallittujen valintojen enimmäismäärä.',
    ],
    'mode'    => [
        'name'         => 'Tulotila',
        'instructions' => 'Kuinka käyttäjien tulisi antaa tiedostojen syöttö?',
        'option'       => [
            'default' => 'Lähetä ja / tai valitse tiedostoja.',
            'select'  => 'Valitse vain tiedostot.',
            'upload'  => 'Lähetä vain tiedostoja.',
        ],
    ],
];
