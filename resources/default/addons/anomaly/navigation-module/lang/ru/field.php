<?php

return [
    'name'          => [
        'name'         => 'Название',
        'instructions' => [
            'menus' => 'Название меню.',
        ],
    ],
    'slug'          => [
        'name'         => 'Идентификатор',
        'instructions' => 'Уникальный текстовый идентификатор, который будет использоваться при отображении меню.',
    ],
    'description'   => [
        'name'         => 'Описание',
        'instructions' => 'Описание меню навигации.',
    ],
    'target'        => [
        'name'         => 'Поведение ссылки при нажатии',
        'instructions' => 'Открытие ссылки в текущем или в новом окне.',
        'option'       => [
            'self'  => 'Открывать ссылку в текущем окне.',
            'blank' => 'Открывать ссылку в новом окне.',
        ],
    ],
    'menu'          => [
        'name' => 'Меню',
    ],
    'type'          => [
        'name' => 'Тип',
    ],
    'class'         => [
        'name'         => 'Класс',
        'instructions' => 'Любые дополнительные классы ссылок в соответствии с инструкциями разработчика.',
    ],
    'allowed_roles' => [
        'name'         => 'Разрешённые группы',
        'instructions' => 'Группы пользователей, которые могут видеть данную ссылку.',
        'warning'      => 'Если разрешённые группы пользователей не указаны, то все смогут видеть данную ссылку.',
    ],
];
