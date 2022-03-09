<?php namespace Visiosoft\LocationModule\Village\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

class VillageTableBuilder extends TableBuilder
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
            'order' => 'ASC',
        ],
    ];
    /**
     * The table assets.
     *
     * @var array
     */

    /**
     * Added for big data problem
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $query->orderBy("id");
    }



    protected $assets = [];

}
