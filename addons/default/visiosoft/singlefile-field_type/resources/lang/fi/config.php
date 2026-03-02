<?php

return [
    'folders' => [
        'name'         => 'Kansiot',
        'instructions' => 'Määritä, mitkä kansiot ovat käytettävissä tässä kentässä. Jätä tyhjä nähdäksesi kaikki kansiot.',
        'warning'      => 'Olemassa olevat kansioiden käyttöoikeudet ovat etusijalla valittuihin kansioihin nähden.',
    ],
    'max'     => [
        'name'         => 'Suurin latauskoko',
        'instructions' => 'Määritä suurin latauskoko <strong>megatavua</strong>.',
        'warning'      => 'Jos sitä ei määritetä, sen sijaan käytetään kansiota max ja palvelimen max.',
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
