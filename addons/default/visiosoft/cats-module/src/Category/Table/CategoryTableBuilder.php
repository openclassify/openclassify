<?php namespace Visiosoft\CatsModule\Category\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Visiosoft\CatsModule\Category\Table\Handler\Delete;

class CategoryTableBuilder extends TableBuilder
{

    public function onQuerying(Builder $query)
    {
        if(!request()->cat){
            $query->whereNull('parent_category_id');
        }

    }

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
        'adcountcalc' => [
            'text' => 'visiosoft.module.cats::view.ad_count_calculate',
            'href' => '/admin/cats/adcountcalc',
        ],
        'catLevelCalc' => [
            'text' => 'visiosoft.module.cats::view.cat_level_calculate',
            'href' => '/admin/cats/catlevelcalc',
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
        'table_view' => 'visiosoft.module.cats::table/table'
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.cats::js/custom-field.js',
            'visiosoft.theme.defaultadmin::js/libraries/sweetalert.min.js',
            'visiosoft.module.cats::js/admin/make_main_category.js',
        ],
    ];
}
