<?php

return [
    'theme' => 'monokai',
    'modes' => [
        'twig'       => [
            'extension' => 'twig',
            'name'      => 'Twig',
            'loader'    => 'twig',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/xml/xml.js',
                'anomaly.field_type.editor::js/codemirror/mode/javascript/javascript.js',
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
                'anomaly.field_type.editor::js/codemirror/mode/vbscript/vbscript.js',
                'anomaly.field_type.editor::js/codemirror/mode/htmlmixed/htmlmixed.js',
                'anomaly.field_type.editor::js/codemirror/mode/twig/twig.js',
            ],
        ],
        'html'       => [
            'extension' => 'html',
            'name'      => 'HTML',
            'loader'    => 'htmlmixed',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/xml/xml.js',
                'anomaly.field_type.editor::js/codemirror/mode/javascript/javascript.js',
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
                'anomaly.field_type.editor::js/codemirror/mode/vbscript/vbscript.js',
                'anomaly.field_type.editor::js/codemirror/mode/htmlmixed/htmlmixed.js',
            ],
        ],
        'css'        => [
            'extension' => 'css',
            'name'      => 'CSS',
            'loader'    => 'css',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
            ],
        ],
        'javascript' => [
            'extension' => 'js',
            'name'      => 'JavaScript',
            'loader'    => 'javascript',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/javascript/javascript.js',
            ],
        ],
        'markdown'   => [
            'loader'    => 'markdown',
            'extension' => 'md',
            'name'      => 'Markdown',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/xml/xml.js',
                'anomaly.field_type.editor::js/codemirror/mode/markdown/markdown.js',
            ],
        ],
        'scss'       => [
            'loader'    => 'text/x-scss',
            'extension' => 'scss',
            'name'      => 'SCSS',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
            ],
        ],
        'less'       => [
            'loader'    => 'text/x-less',
            'extension' => 'less',
            'name'      => 'LESS',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
            ],
        ],
        'json'       => [
            'loader'    => 'application/ld+json',
            'extension' => 'json',
            'name'      => 'JSON',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/javascript/json.js',
                'anomaly.field_type.editor::js/codemirror/mode/javascript/json-.js',
            ],
        ],
        'yaml'       => [
            'loader'    => 'text/x-yaml',
            'extension' => 'yaml',
            'name'      => 'YAML',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/yaml/yaml.js',
            ],
        ],
        'php'        => [
            'loader'    => 'application/x-httpd-php',
            'extension' => 'php',
            'name'      => 'PHP',
            'styles'    => [],
            'scripts'   => [
                'anomaly.field_type.editor::js/codemirror/mode/htmlmixed/htmlmixed.js',
                'anomaly.field_type.editor::js/codemirror/mode/xml/xml.js',
                'anomaly.field_type.editor::js/codemirror/mode/javascript/javascript.js',
                'anomaly.field_type.editor::js/codemirror/mode/css/css.js',
                'anomaly.field_type.editor::js/codemirror/mode/clike/clike.js',
                'anomaly.field_type.editor::js/codemirror/mode/php/php.js',
            ],
        ],
    ],
];
