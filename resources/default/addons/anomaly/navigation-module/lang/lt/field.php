<?php

return [
    'name' => [
        'name' => 'Pavadinimas',
        'instructions' => [
            'menus' => 'Trumpas meniu pavadinimas',
        ],
    ],
    'slug' => [
        'name' => 'Slug',
        'instructions' => 'Slug naudojamas atvaizduojant meniu.',
    ],
    'description' => [
        'name' => 'Aprašymas',
        'instructions' => 'Meniu aprašymas',
    ],
    'target' => [
        'name' => 'Atidarymo būdas',
        'instructions' => 'Kaip ši nuoroda turėtų atsidaryti?',
        'option' => [
            'self' => 'Atidaryti dabartiniame lange.',
            'blank' => 'Atidaryti naujame lange.',
        ],
    ],
    'class' => [
        'name' => 'CSS klasė',
        'instructions' => 'Nurodykite papildomas CSS klases',
    ],
    'allowed_roles' => [
        'name' => 'Leidžiamos rolės',
        'instructions' => 'Nurodykite roles kurių naudotojai gali matyti šią nuorodą.',
        'warning' => 'Jei naudotojų rolės nenurodytos, šią nuorodą matyts visi.',
    ],
];
