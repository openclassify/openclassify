<?php

return [
    'url'      => [
        'name'         => 'URL',
        'instructions' => 'Specify the URL for the XML feed.',
    ],
    'template' => [
        'name'         => 'Template',
        'instructions' => 'Specify the output template for the XML feed. {{ widget.data.items }} returns an array of <a href="https://packagist.org/packages/simplepie/simplepie" target="_blank">SimplePie</a> objects.',
    ],
];
