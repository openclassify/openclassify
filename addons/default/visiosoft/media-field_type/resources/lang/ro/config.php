<?php

return [
    'folders' => [
        'name'         => 'Dosare',
        'instructions' => 'Specificați ce foldere sunt disponibile pentru acest câmp. Lăsați gol pentru a afișa toate folderele.',
        'warning'      => 'Permisiunile de folder existente au prioritate față de directoarele selectate.',
    ],
    'min'     => [
        'label'        => 'Selecții minime',
        'instructions' => 'Introduceți numărul minim de selecții permise.',
    ],
    'max'     => [
        'label'        => 'Selectări maxime',
        'instructions' => 'Introduceți numărul maxim de selecții permise.',
    ],
    'mode'    => [
        'name'         => 'Modul de introducere',
        'instructions' => 'Cum ar trebui utilizatorii să furnizeze introducerea fișierului?',
        'option'       => [
            'default' => 'Încărcați și / sau selectați fișiere.',
            'select'  => 'Selectați numai fișiere.',
            'upload'  => 'Încărcați numai fișiere.',
        ],
    ],
];
