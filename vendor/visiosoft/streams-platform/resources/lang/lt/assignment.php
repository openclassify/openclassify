<?php

return [
    'field'        => [
        'name'         => 'Laukas',
        'label'        => 'Laukas',
        'instructions' => 'Pasirinkite priskiriamą lauką.',
    ],
    'label'        => [
        'name'         => 'Etiketė',
        'instructions' => 'Etiketės bus naudojamos tik formoms. Jei paliksite neįrašytą, bus naudojamas lauko pavadinimas.',
    ],
    'required'     => [
        'name'         => 'Privalomas',
        'label'        => 'Ar šis laukas privalomas?',
        'instructions' => 'Jei privalomas, tuomet laukas TURI turėti reikšmę.',
    ],
    'unique'       => [
        'name'         => 'Unikalus',
        'label'        => 'Ar šis laukas unikalus?',
        'instructions' => 'Jei unikalus, tuomet TURI turėti unikalią ir reikšmę.',
    ],
    'placeholder'  => [
        'name'         => 'Įvesties vieta',
        'instructions' => 'Jei palaikoma, įvesties vietoje bus rodomi vietovardžiai, kai nebuvo įvesta jokių įvesčių.',
    ],
    'translatable' => [
        'name'         => 'Išverčiamas',
        'label'        => 'Ar šis laukas išverčiamas?',
        'instructions' => 'Jei išverčiamas, tuomet laukas bus prieinamas visose lokalėse.',
        'warning'      => 'Susijęs lauko tipas nepalaiko išverstų reikšmių.',
    ],
    'instructions' => [
        'name'         => 'Instrukcijos',
        'instructions' => 'Laukų instrukcijos bus rodomos formose, kad padėtų vartotojams.',
    ],
    'warning'      => [
        'name'         => 'Įspėjimas',
        'instructions' => 'Įspėjimai padeda atkreipti dėmesį į svarbią informaciją.',
    ],
];
