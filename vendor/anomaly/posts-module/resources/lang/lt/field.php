<?php

return [
    'name' => [
        'name' => 'Vardas',
        'instructions' => [
            'types' => 'Užvardinkite šio tipo įrašą trumpai ir aiškiai.',
            'categories' => 'Užvardinkite šią kategoriją trumpai ir aiškiai.',
        ],
    ],
    'title' => [
        'name' => 'Pavadinimas',
        'instructions' => 'Įrašui parinkite neperilgą ir aiškų pavadinimą.',
    ],
    'slug' => [
        'name' => 'Slug',
    ],
    'description' => [
        'name' => 'Aprašymas',
        'instructions' => [
            'types' => 'Aprašykite įrašo tipą plačiau.',
            'categories' => 'Aprašykite kategoriją plačiau.',
        ],
        'warning' => 'Tai gali būti prieinama viešai arba ne, priklausomai nuo to kaip suprogramuotas internetinis puslapis.',
    ],
    'summary' => [
        'name' => 'Santrauka',
        'instructions' => 'Parašykite trumpą santrauką to ką ketinate skelbti įraše.',
    ],
    'category' => [
        'name' => 'Kategorija',
        'instructions' => 'Parinkite kategoriją kuriai priklauso įrašas.',
    ],
    'meta_title' => [
        'name' => 'Meta title',
        'instructions' => 'Įrašykite pavadinimą SEO reikmėms.',
        'warning' => 'Įrašo pavadinimas bus panaudotas pagal nutylėjimą',
    ],
    'meta_description' => [
        'name' => 'Meta description',
        'instructions' => 'Įrašykite aprašymą SEO reikmėms.',
    ],
    'meta_keywords' => [
        'name' => 'Meta keywords',
        'instructions' => 'Įrašykite raktažodžius SEO reikmėms.',
    ],
    'theme_layout' => [
        'name' => 'Temos išdėstymas',
    ],
    'layout' => [
        'name' => 'Įrašo išdėstymas',
        'instructions' => 'Išdėstymas naudojamas įrašo turinio atvaizdavimui.',
    ],
    'tags' => [
        'name' => 'Žymės',
        'instructions' => 'Įrašykite žymes kurios leistų organizuoti įrašų grupavimą su kitais.',
    ],
    'enabled' => [
        'name' => 'Išjungtas',
        'label' => 'Ar šis įrašas išjungtas?',
    ],
    'publish_at' => [
        'name' => 'Publikavimo data/laikas',
        'instructions' => 'Nurodykite įrašo publikavimo datą/laiką',
        'warning' => 'Jei nurodėte ateities datą ir laiką, tuomet įrašas nebus matomas iki tol.',
    ],
    'author' => [
        'name' => 'Autorius',
        'instructions' => 'Nurodykite šio įrašo autorių',
    ],
    'status' => [
        'name' => 'Statusas',
        'option' => [
            'live' => 'Aktyvus',
            'draft' => 'Projektas',
            'scheduled' => 'Suplanuotas',
        ],
    ],
    'content' => [
        'name' => 'Turinys',
    ],
];
