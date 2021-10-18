<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\AdvsModule\Adv\Table\Views\All;
use Visiosoft\AdvsModule\Adv\Table\Views\unfinished;

class AdvTableBuilder extends TableBuilder
{
    protected $views = [
        'all' => [
            'view' => All::class,
            'slug' => 'all',
            'text' => 'streams::view.all',
        ],
        'advanced' => [
            'view' => All::class,
            'slug' => 'advanced',
            'text' => 'module::view.advanced',
        ],
        'trash',
        'unfinished' => [
            'view' => unfinished::class
        ],

    ];

    protected $buttons = [];

    protected $actions = [
        'delete' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Delete::class,
        ],
        'approve' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Approve::class,
            'class' => 'btn btn-success'
        ],
        'decline' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Decline::class,
            'class' => 'btn btn-danger'
        ],
        'extend' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Extend::class,
            'class' => 'btn btn-info'
        ],
        'convert_currency' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\ConvertCurrency::class,
            'class' => 'btn btn-warning'
        ],
    ];

    protected $options = [
        'order_by' => [
            'id' => 'DESC',
        ],
        'table_view' => 'visiosoft.module.advs::admin/table/table'

    ];

    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.advs::js/admin/advanced.js',
            'visiosoft.module.advs::js/admin/filter-user.js',
        ],
        'styles.css' => [
            'visiosoft.module.advs::css/admin/filter-user.css',
        ],
    ];
}
