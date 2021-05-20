<?php

return [
    'related'    => [
        'label'        => 'Свързан поток',
        'instructions' => 'Посочете свързаните записи в потока, които да се показват в падащото меню.',
    ],
    'mode'       => [
        'label'  => 'Режим на въвеждане',
        'option' => [
            'tags'       => 'Етикети',
            'lookup'     => 'Погледни нагоре',
            'checkboxes' => 'Квадратчета за отметка',
        ],
    ],
    'min'        => [
        'label'        => 'Минимални селекции',
        'instructions' => 'Посочете минималния брой разрешени селекции.',
    ],
    'max'        => [
        'label'        => 'Максимален избор',
        'instructions' => 'Посочете максималния брой разрешени селекции.',
    ],
    'title_name' => [
        'label'        => 'Поле за заглавие',
        'placeholder'  => 'първо име',
        'instructions' => 'Посочете <strong>slug</strong> за показване за падащи опции / опции за търсене.<br>Можете да посочите синтаксируеми заглавия като <strong>{entry.first_name} {entry.last_name}</strong><br>По подразбиране ще се използва заглавната колона на свързания поток.',
    ],
];