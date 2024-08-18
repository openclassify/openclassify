<?php namespace Visiosoft\LocationModule\Neighborhood\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\LocationModule\Neighborhood\Table\Handler\Delete;

class NeighborhoodTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'filter' => 'search',
            'fields' => [
                'name',
                'slug',
                'order',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'add_sub_village' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/village/create?village={entry.id}'
        ],
        'sub_village' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/village?neighborhood={entry.id}'
        ],
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete' => [
            'handler' => Delete::class,
        ],
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'order' => 'ASC',
        ],
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
