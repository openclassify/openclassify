<?php

return [
    'line_breaks'      => env('WYSIWYG_LINE_BREAKS', false),
    'remove_new_lines' => env('WYSIWYG_REMOVE_NEW_LINES', false),

    'buttons'        => [
        'format'         => [],
        'bold'           => [
            'icon' => 'fa fa-bold',
        ],
        'italic'         => [
            'icon' => 'fa fa-italic',
        ],
        'deleted'        => [
            'icon' => 'fa fa-strikethrough',
        ],
        'lists'          => [
            'icon' => 'fa fa-list',
        ],
        'link'           => [
            'icon' => 'fa fa-link',
        ],
        'horizontalrule' => [
            'icon' => 'fa fa-minus',
        ],
        'underline'      => [
            'icon' => 'fa fa-underline',
        ],

    ],
    'plugins'        => [
        'fontcolor'  => [
            'button'  => 'fa fa-font',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/fontcolor.js',
            ],
        ],        
        'alignment'    => [
            'icon'    => 'fa fa-align-left',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/alignment/alignment.js',
            ],
            'styles'  => [
                'anomaly.field_type.wysiwyg::js/plugins/alignment/alignment.css',
            ],
        ],
        'clips'        => [
            'icon'    => 'fa fa-scissors',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/clips/clips.js',
            ],
            'styles'  => [
                'anomaly.field_type.wysiwyg::js/plugins/clips/clips.css',
            ],
        ],
        'inlinestyle'  => [
            'button'  => 'inline',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/inlinestyle.js',
            ],
        ],
        'table'        => [
            'icon'    => 'fa fa-table',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/table.js',
            ],
        ],
        'video'        => [
            'icon'    => 'fa fa-video-camera',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/video.js',
            ],
        ],
        'filemanager'  => [
            'icon'    => 'fa fa-paperclip',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/filemanager.js',
            ],
        ],
        'imagemanager' => [
            'icon'    => 'fa fa-picture-o',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/imagemanager.js',
            ],
        ],
        'source'       => [
            'icon'    => 'fa fa-code',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/source.js',
            ],
        ],
        'fullscreen'   => [
            'icon'    => 'fa fa-arrows-alt',
            'scripts' => [
                'anomaly.field_type.wysiwyg::js/plugins/fullscreen.js',
            ],
        ],
    ],
    'configurations' => [
        'default' => [
            'buttons' => [
                'format',
                'bold',
                'italic',
                'deleted',
                'lists',
                'link',
                'horizontalrule',
                'underline',
            ],
            'plugins' => [
                'source',
                'table',
                'video',
                'inlinestyle',
                'filemanager',
                'imagemanager',
                'fullscreen',
                'alignment',
            ],
        ],
        'basic'   => [
            'buttons' => [
                'bold',
                'italic',
                'lists',
                'link',
                'underline',
            ],
            'plugins' => [
                'fullscreen',
            ],
        ],
    ],
];
