<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class CfvalueTableBuilder extends TableBuilder
{
    protected $buttons = [
        'edit'
    ];

    protected $actions = [
        'delete'
    ];
}
