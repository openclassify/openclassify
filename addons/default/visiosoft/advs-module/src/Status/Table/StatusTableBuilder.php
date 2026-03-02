<?php namespace Visiosoft\AdvsModule\Status\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class StatusTableBuilder extends TableBuilder
{
    protected $buttons = [
        'edit'
    ];

    protected $actions = [
        'delete'
    ];
}
