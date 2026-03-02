<?php

return [
    'folders' => [
        'name'         => 'mappar',
        'instructions' => 'Ange vilka mappar som är tillgängliga för det här fältet. Lämna tomt för att visa alla mappar.',
        'warning'      => 'Befintliga mappbehörigheter har företräde framför valda mappar.',
    ],
    'min'     => [
        'label'        => 'Minsta val',
        'instructions' => 'Ange det minsta antalet tillåtna val.',
    ],
    'max'     => [
        'label'        => 'Maximala val',
        'instructions' => 'Ange det maximala antalet tillåtna val.',
    ],
    'mode'    => [
        'name'         => 'Inmatningsläge',
        'instructions' => 'Hur ska användare tillhandahålla filinmatning?',
        'option'       => [
            'default' => 'Ladda upp och / eller välj filer.',
            'select'  => 'Välj bara filer.',
            'upload'  => 'Ladda bara upp filer.',
        ],
    ],
];
