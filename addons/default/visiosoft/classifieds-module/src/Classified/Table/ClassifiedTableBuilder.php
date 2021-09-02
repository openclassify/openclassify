<?php namespace Visiosoft\ClassifiedsModule\Classified\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\ClassifiedsModule\Classified\Table\Views\All;
use Visiosoft\ClassifiedsModule\Classified\Table\Views\unfinished;

class ClassifiedTableBuilder extends TableBuilder
{
    protected $views = [
        'all' => [
            'view' => All::class,
            'slug' => 'all',
            'text' => 'streams::view.all',
        ],
        'classifiedanced' => [
            'view' => All::class,
            'slug' => 'classifiedanced',
            'text' => 'module::view.classifiedanced',
        ],
        'trash',
        'unfinished' => [
            'view' => unfinished::class
        ],

    ];

    protected $buttons = [];

    protected $actions = [
        'delete' => [
            'handler' => \Visiosoft\ClassifiedsModule\Classified\Table\Handler\Delete::class,
        ],
        'approve' => [
            'handler' => \Visiosoft\ClassifiedsModule\Classified\Table\Handler\Approve::class,
            'class' => 'btn btn-success'
        ],
        'decline' => [
            'handler' => \Visiosoft\ClassifiedsModule\Classified\Table\Handler\Decline::class,
            'class' => 'btn btn-danger'
        ],
        'extend' => [
            'handler' => \Visiosoft\ClassifiedsModule\Classified\Table\Handler\Extend::class,
            'class' => 'btn btn-info'
        ],
        'convert_currency' => [
            'handler' => \Visiosoft\ClassifiedsModule\Classified\Table\Handler\ConvertCurrency::class,
            'class' => 'btn btn-warning'
        ],
    ];

    protected $options = [
        'order_by' => [
            'id' => 'DESC',
        ]
    ];

    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.classifieds::js/admin/classifiedanced.js',
            'visiosoft.module.classifieds::js/admin/filter-user.js',
        ],
        'styles.css' => [
            'visiosoft.module.classifieds::css/admin/filter-user.css',
        ],
    ];
}
