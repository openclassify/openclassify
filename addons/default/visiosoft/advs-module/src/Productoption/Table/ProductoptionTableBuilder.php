<?php namespace Visiosoft\AdvsModule\Productoption\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class ProductoptionTableBuilder extends TableBuilder
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
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
