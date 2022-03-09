<?php

return [
    'login' => [
        'label' => 'Prisijungimo laukai',
        'instructions' => 'Kurį lauką reikėtų naudoti prisijungiant?',
        'option' => [
            'email' => 'El.pašas',
            'username' => 'Vartotojo vardas',
        ],
    ],
    'activation_mode' => [
        'label' => 'Aktyvavimo rėžimas',
        'instructions' => 'Kaip vartotojai turėtų būti aktyvuojami po registracijos?',
        'option' => [
            'email' => 'Išsiųsti aktyvavimo el. laišką vartotojui.',
            'manual' => 'Įpareigoti administratorių aktyvuoti vartotoją rankiniu būdu.',
            'automatic' => 'Automatiškai aktyvuoti vartotoją iš karto po registracijos.',
        ],
    ],
];
