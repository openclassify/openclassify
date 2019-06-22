<?php namespace Visiosoft\LocationModule\Country\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class CountryTableBuilder extends TableBuilder
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
    protected $filters = [];

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
        'add_sub_cities' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/cities/create?cities={entry.id}'
        ],
        'sub_cities' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/location/cities?country={entry.id}'
        ],
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

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'id' => 'DESC',
        ],
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
