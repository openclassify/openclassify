<?php

return [
    'folders' => [
        'name'         => 'mappar',
        'instructions' => 'Ange vilka mappar som är tillgängliga för det här fältet. Lämna tomt för att visa alla mappar.',
        'warning'      => 'Befintliga mappbehörigheter har företräde framför valda mappar.',
    ],
    'max'     => [
        'name'         => 'Max uppladdningsstorlek',
        'instructions' => 'Ange den maximala uppladdningsstorleken i <strong>megabyte</strong>.',
        'warning'      => 'Om det inte anges kommer mappen max och sedan server max att användas istället.',
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
