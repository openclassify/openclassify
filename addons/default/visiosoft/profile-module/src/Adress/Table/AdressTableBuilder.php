<?php namespace Visiosoft\ProfileModule\Adress\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;

class AdressTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
    ];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'filter' => 'search',
            'fields' => [
                'user_no',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'first_name','last_name','email'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'show' => [
            'type' => 'primary',
            'icon' => 'fa fa-eye',
            'href' => '/admin/profile/adress/edit/{entry.id}?filter_search={entry.id}',
        ],
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
