<?php

return [
    'folders' => [
        'name'         => 'Dosjet',
        'instructions' => 'Specifikoni cilat dosje janë të disponueshëm për këtë fushë. Lini bosh për të shfaqur të gjithë dosjet.',
        'warning'      => 'Lejet ekzistuese të dosjeve kanë përparësi ndaj dosjeve të zgjedhura.',
    ],
    'max'     => [
        'name'         => 'Madhësia e ngarkimit maksimal',
        'instructions' => 'Specifikoni madhësinë maksimale të ngarkimit në <strong>megabajt</strong>.',
        'warning'      => 'Nëse nuk specifikohet maksimumi i dosjes dhe më pas do të përdoret maksimumi i serverit.',
    ],
    'mode'    => [
        'name'         => 'Mënyra e hyrjes',
        'instructions' => 'Si duhet të sigurojnë përdoruesit futjen e skedarit?',
        'option'       => [
            'default' => 'Ngarkoni dhe / ose zgjidhni skedarë.',
            'select'  => 'Zgjidhni vetëm skedarët.',
            'upload'  => 'Ngarko skedarët vetëm.',
        ],
    ],
];
