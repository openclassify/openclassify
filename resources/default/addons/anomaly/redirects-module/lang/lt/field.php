<?php

return [
    'from' => [
        'name' => 'Iš',
        'label' => 'Peradresavimas iš',
        'placeholder' => 'foo/bar/{var}',
        'instructions' => 'Nurodykite tikslų kelią arba struktūrą kaip peradresuoti. Pavyzdžiui foo/bar/{var} arba foo/bar arba http://{account}.old.com/{path}.

',
        'warning' => 'Neįterpinėkite vietos žymių kaip pavyzdžiui en/foo/bar/{var}',
    ],
    'to' => [
        'name' => 'Į',
        'label' => 'Peradresuoti į',
        'placeholder' => 'bar/{var}',
        'instructions' => 'Nurodykite tikslų kelią, pakeitimo struktūrą arba URL į kurį nukreipiama. Pavyzdžiui bar/{var} ar bar/baz ar https://new.com/account/{account}/{path}.',
    ],
    'status' => [
        'name' => 'Statusas',
        'instructions' => 'Kokio tipo šis peradresavimas?',
        'option' => [
            '301' => '301 - pastovusis peradresavimas',
            '302' => '302 - laikinasis peradresavimas',
        ],
    ],
    'secure' => [
        'name' => 'Saugus',
        'label' => 'Peradresuoti į saugų URL.',
        'instructions' => 'Ar norite saugaus sujungimo peradresavimo metu?',
    ],
];
