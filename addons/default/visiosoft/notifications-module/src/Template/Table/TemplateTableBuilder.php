<?php namespace Visiosoft\NotificationsModule\Template\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class TemplateTableBuilder extends TableBuilder
{
    protected $filters = [
        'slug'
    ];

    protected $buttons = [
        'edit'
    ];

    protected $actions = [
        'delete'
    ];

    protected $options = [
        'order_by' => [
            'id' => 'DESC'
        ],
    ];
}
