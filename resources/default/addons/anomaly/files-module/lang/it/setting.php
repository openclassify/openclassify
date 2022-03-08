<?php

return [
    'max_upload_size'      => [
        'name'         => 'Dimensione massima di upload',
        'instructions' => 'Indica la dimensione massima di un file che può essere caricato. ',
        'warning'      => 'Attualmente la dimensione massima impostata sul tuo server è di ' . max_upload_size() . 'MB',
    ],
    'max_parallel_uploads' => [
        'name'         => 'Numero massimo di upload paralleli',
        'instructions' => 'Specifica il numero massimo di file che possono essere caricati contemporaneamente.',
    ],
];
