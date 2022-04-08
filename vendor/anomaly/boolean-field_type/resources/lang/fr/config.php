<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'Quel type de choix souhaitez-vous afficher ?',
        'option'       => [
            'switch'   => 'On / Off (switch)',
            'checkbox' => 'Case à cocher (checkbox)',
        ],
    ],
    'label'         => [
        'label'        => 'Choice Label',
        'instructions' => 'This label is displayed right next to the input.',
    ],
    'on_text'       => [
        'label'        => 'Texte "On"',
        'instructions' => 'Texte pour le choix "On" lorsque le switch est utilisé.',
        'placeholder'  => 'On',
    ],
    'on_color'      => [
        'label'        => 'Couleur "On"',
        'instructions' => 'Couleur pour le choix "On" lorsque le switch est utilisé.',
        'option'       => [
            'green'  => 'Vert',
            'blue'   => 'Bleu',
            'orange' => 'Orange',
            'red'    => 'Rouge',
            'gray'   => 'Gris',
        ],
    ],
    'off_text'      => [
        'label'        => 'Texte "Off"',
        'instructions' => 'Texte pour le choix "Off" lorsque le switch est utilisé.',
        'placeholder'  => 'Off',
    ],
    'off_color'     => [
        'label'        => 'Couleur "Off"',
        'instructions' => 'Couleur pour le choix "Off" lorsque le switch est utilisé.',
        'option'       => [
            'green'  => 'Vert',
            'blue'   => 'Bleu',
            'orange' => 'Orange',
            'red'    => 'Rouge',
            'gray'   => 'Gris',
        ],
    ],
    'default_value' => [
        'label'        => 'Etat par défaut',
        'instructions' => 'Quel est la valeur par défaut pour le switch ?',
        'option'       => [
            'on'  => 'ON',
            'off' => 'OFF',
        ],
    ],
];
