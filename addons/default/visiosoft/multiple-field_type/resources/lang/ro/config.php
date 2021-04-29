<?php

return [
    'related'    => [
        'label'        => 'Flux asociat',
        'instructions' => 'Specificați intrările de flux aferente care vor fi afișate în meniul derulant.',
    ],
    'mode'       => [
        'label'  => 'Modul de introducere',
        'option' => [
            'tags'       => 'Etichete',
            'lookup'     => 'Privește în sus',
            'checkboxes' => 'Casete de selectare',
        ],
    ],
    'min'        => [
        'label'        => 'Selecții minime',
        'instructions' => 'Specificați numărul minim de selecții permise.',
    ],
    'max'        => [
        'label'        => 'Selecții maxime',
        'instructions' => 'Specificați numărul maxim de selecții permise.',
    ],
    'title_name' => [
        'label'        => 'Câmpul de titlu',
        'placeholder'  => 'Nume',
        'instructions' => 'Specificați <strong>slug</strong> de câmp de afișat pentru opțiunile drop-down / căutare.<br>Puteți specifica titluri analizate precum <strong>{entry.first_name} {entry.last_name}</strong><br>Coloana de titlu a fluxului aferent va fi utilizată în mod implicit.',
    ],
];
