<?php

return [
    'from'   => [
        'name'         => 'Från',
        'label'        => 'Vidarebefordra Från',
        'placeholder'  => 'exempel/url/{denna-bit-aer-dynamisk}',
        'instructions' => 'Specificera en exakt sökväg eller ett mönster som ska vidarebefordras. Exempelvis <strong>exempel/url/{denna-bit-aer-frivillig}</strong> or <strong>exempel/url</strong>.',
    ],
    'to'     => [
        'name'         => 'Till',
        'label'        => 'Vidarebefordra Till',
        'placeholder'  => 'exempel-url/{denna-bit-aer-dynamisk}',
        'instructions' => 'Specificiera en exakt sökväg, ett ersättningsmönster eller URL ska vidarebefordras till. Exempelvis <strong>exempel/url/{denna-bit-aer-dynamisk}</strong> or <strong>exempel/url</strong>.',
    ],
    'status' => [
        'name'         => 'Status',
        'instructions' => 'Vad för sorts vidarebefordring är detta?',
        'option'       => [
            '301' => '301 - Permanent Vidarebefordring',
            '302' => '302 - Temporär Vidarebefordring',
        ],
    ],
    'secure' => [
        'name'         => 'Säker',
        'label'        => 'Vidarebefordra till en säker URL?',
        'instructions' => 'Vill du tvinga anslutningen att vara säker när vidarebefordring sker?',
    ],
];
