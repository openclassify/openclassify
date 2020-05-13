<?php

return [
    'folders' => [
        'name'         => 'Dosare',
        'instructions' => 'Specificați ce foldere sunt disponibile pentru acest câmp. Lăsați gol pentru a afișa toate folderele.',
        'warning'      => 'Permisiunile de folder existente au prioritate față de directoarele selectate.',
    ],
    'max'     => [
        'name'         => 'Dimensiunea maximă a încărcării',
        'instructions' => 'Specificați dimensiunea maximă de încărcare în <strong>megabyte</strong>.',
        'warning'      => 'Dacă nu este specificat folderul max și apoi serverul max va fi utilizat în schimb.',
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
