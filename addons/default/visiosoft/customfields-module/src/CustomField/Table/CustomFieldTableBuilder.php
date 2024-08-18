<?php namespace Visiosoft\CustomfieldsModule\CustomField\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Visiosoft\CustomfieldsModule\Parent\ParentModel;

class CustomFieldTableBuilder extends TableBuilder
{
    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'sort_order' => 'ASC',
        ],
        'sortable' => true
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.customfields::js/admin/customfields.js',
        ],
    ];

}
