<?php

return [
    'name' => [
        'name' => 'Vardas',
        'instructions' => 'Parinkite trumpą ir aiškų užvadinimą šiam darbalaukiui.',
    ],
    'title' => [
        'name' => 'Pavadinimas',
        'instructions' => 'Parinkite trumpą ir aiškų užvadinimą šiam papildiniui.',
    ],
    'slug' => [
        'name' => 'Slug',
        'instructions' => 'Šis slug jau naudojamas tarp darbalaukio URL.',
    ],
    'description' => [
        'name' => 'Aprašymas',
        'instructions' => [
            'dashboards' => 'Aprašykite šį darbalaukį plačiai.',
            'widgets' => 'Aprašykite šį papildinį.',
        ],
    ],
    'layout' => [
        'name' => 'Išdėstymas',
        'instructions' => 'Išdėstymas nustato, kaip jūs galite organizuoti darbalaukio papildinius.',
        'option' => [
            '24' => 'Vienas stulpelis',
            '12-12' => 'Du vienodi stulpeliai',
            '16-8' => 'Du stulpeliai - kairysis platesnis',
            '8-16' => 'Du stulpeliai - dešinys platesnis',
            '8-8-8' => 'Trys vienodi stulpeliai',
            '6-12-6' => 'Trys stulpeliai - vidurinis platesnis',
            '12-6-6' => 'Trys stulpeliai - kairysis platesnis',
            '6-6-12' => 'Trys stulpeliai - dešinysis platesnis',
            '6-6-6-6' => 'Keturi vienodi stulpeliai',
        ],
    ],
    'dashboard' => [
        'name' => 'Darbalaukis',
        'instructions' => 'Pasirinkite kuriam darbalaukiui ši papildinys priklauso.',
    ],
    'extension' => [
        'name' => 'Plėtinys',
    ],
    'pinned' => [
        'name' => 'Prisegtas',
        'label' => 'Prisegti į papildinį?',
        'instructions' => 'Prisegtas papildinys pilno pločio, perkeltas į darbalaukio viršų.',
    ],
    'allowed_roles' => [
        'name' => 'Leidžiamos rolės',
        'instructions' => [
            'dashboards' => 'Nurodykite kurie vartotojai turi prieigą prie šio darbalaukio.',
            'widgets' => 'Nurodykite kurie vartotoja gali matyti šį papildinį.',
        ],
        'warning' => [
            'dashboards' => 'Jei nėra nurodytų rolių, tuomet kiekvienas turintis prieigą prie šio papildinio gali prieiti ir prie darbalaukio.',
            'widgets' => 'Jei nėra nurodytų rolių, tuomet kiekvienas turintis prieigą prie šio papildinio gali prieiti ir prie šio papildinio.',
        ],
    ],
];
