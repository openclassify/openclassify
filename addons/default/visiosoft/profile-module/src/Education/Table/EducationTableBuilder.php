<?php namespace Visiosoft\ProfileModule\Education\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class EducationTableBuilder extends TableBuilder
{
    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];
}
