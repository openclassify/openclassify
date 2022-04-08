<?php

return [
    'date' => [
        'F j, Y' => date('F j, Y'), // July 10, 2015
        'j F, Y' => date('j F, Y'), // 10 July, 2015
        'j M, y' => date('j M, y'), // 10 Jul, 15
        'm/d/Y'  => date('m/d/Y'), // 07/10/2015
        'd/m/Y'  => date('d/m/Y'), // 10/07/2015
        'Y-m-d'  => date('Y-m-d'), // 2015-07-10
        'd.m.Y'  => date('d.m.Y'), // 10.07.2015
    ],
    'time' => [
        'g:i A' => date('g:i A'), // 4:00 PM
        'H:i'   => date('H:i'), // 16:00
    ],
];
