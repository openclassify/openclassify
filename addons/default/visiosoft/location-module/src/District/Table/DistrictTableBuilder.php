<?php namespace Visiosoft\LocationModule\District\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\LocationModule\District\Table\Handler\Delete;

class DistrictTableBuilder extends TableBuilder
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
        'add_sub_neighborhoods' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/neighborhoods/create?neighborhoods={entry.id}'
        ],
        'sub_neighborhoods' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/neighborhoods?district={entry.id}'
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
