<?php namespace Visiosoft\AdvsModule\Adv\Table;

use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\UsersModule\UsersModule;
use Illuminate\Database\Eloquent\Builder;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Handler\AdvHandler;
use Visiosoft\AdvsModule\Category\CategoryModel;
use Visiosoft\PackagesModule\User\UserModel;

class AdvTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */

    public function onQuerying(Builder $query)
    {
        $query->where('slug', "!=", "");
    }

    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'fields' => [
              'name',
              'advs_desc',
            ]
        ],
        'country',
        'id' => [
            'heading' => 'ID',
            'filter' => 'input'
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
    protected $buttons = [];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
        'approve' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Approve::class,
            'class' => 'btn btn-success'
        ],
        'decline' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Decline::class,
            'class' => 'btn btn-danger'
        ],
        'extend' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\Extend::class,
            'class' => 'btn btn-info'
        ],
        'convert_currency' => [
            'handler' => \Visiosoft\AdvsModule\Adv\Table\Handler\ConvertCurrency::class,
            'class' => 'btn btn-warning'
        ],
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
