<?php

return [
    'Anomaly\PagesModule\Page\PageModel' => [
        'filters' => [
            'search' => [
                'fields' => [
                    'title',
                    'path',
                ],
            ],
        ],
        'columns' => [
            'title',
            'path',
        ],
    ],
];
