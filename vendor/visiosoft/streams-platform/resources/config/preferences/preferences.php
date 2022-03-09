<?php

return [
    'per_page'    => [
        'env'      => 'RESULTS_PER_PAGE',
        'bind'     => 'streams::system.per_page',
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                5   => 5,
                10  => 10,
                15  => 15,
                25  => 25,
                50  => 50,
                75  => 75,
                100 => 100,
                150 => 150,
            ],
        ],
    ],
    'timezone'    => [
        'env'    => 'APP_TIMEZONE',
        'bind'   => 'app.timezone',
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'mode'    => 'search',
            'handler' => 'timezones',
        ],
    ],
    'date_format' => [
        'env'         => 'DATE_FORMAT',
        'bind'        => 'streams::datetime.date_format',
        'type'        => 'anomaly.field_type.select',
        'placeholder' => false,
        'required'    => true,
        'config'      => [
            'options' => [
                'j F, Y' => date('j F, Y'), // 10 July, 2015
                'j M, y' => date('j M, y'), // 10 Jul, 15
                'm/d/Y'  => date('m/d/Y'),  // 07/10/2015
                'd/m/Y'  => date('d/m/Y'),  // 10/07/2015
                'Y-m-d'  => date('Y-m-d'),  // 2015-07-10
                'd.m.Y'  => date('d.m.Y'),  // 10.07.2015
            ],
        ],
    ],
    'time_format' => [
        'env'         => 'TIME_FORMAT',
        'bind'        => 'streams::datetime.time_format',
        'type'        => 'anomaly.field_type.select',
        'placeholder' => false,
        'required'    => true,
        'config'      => [
            'options' => [
                'g:i A' => date('g:i A'),   // 4:00 PM
                'g:i a' => date('g:i a'),   // 4:00 pm
                'H:i'   => date('H:i'),     // 16:00
            ],
        ],
    ],
];
