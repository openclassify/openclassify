<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class ProductoptionsValueTableBuilder extends TableBuilder
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
    	'name', 'product_option'
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
    	'title' => [
    		'value' => 'entry.name'
	    ],
	    'product_option',
    ];

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
