<?php namespace Visiosoft\CatsModule\Category\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\CatsModule\Category\Table\Handler\Delete;

class CategoryTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'all',
        'trash',
        'clean_subcategories' => [
            'href' => '/admin/cats/clean_subcats',
        ],
    ];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [

    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'name',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit' => [
            'href' => '/admin/cats/edit/{entry.id}?parent={entry.parent_category_id}'
        ],
        'add_sub_category' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/cats/create?parent={entry.id}'
        ],
        'sub_category' => [
            'icon' => 'fa fa-caret-square-o-down',
            'type' => 'success',
            'href' => '/admin/cats?cat={entry.id}'
        ],
        'delete' => [
            'icon' => 'fa fa-trash',
            'type' => 'danger',
            'href' => '/admin/cats/category/delete/{entry.id}?parent={entry.parent_category_id}'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete' => [
            'handler' => Delete::class
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [

    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.cats::js/custom-field.js',
        ],
    ];
}
