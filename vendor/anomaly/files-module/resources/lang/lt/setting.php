<?php

return [
    'max_upload_size'      => [
        'name'         => 'Maksimalus įkėlimo dydis',
        'instructions' => 'Nurodykite maksimalų įkeliamų failų dydį.',
        'warning'      => 'Šiuo metu serveryje maksimalus įkėlimo dydis yra ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Maksimalus kiekis lygiagrečių įkėlimų',
        'instructions' => 'Nurodykite koks maksimalus failų kiekis gali būti įkeliamas vienu metu.',
    ],
];
