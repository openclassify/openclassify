<?php namespace Visiosoft\ProfileModule\Profile\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class ProfileTableBuilder extends TableBuilder
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
                'gsm_phone',
                'land_phone','office_phone','register_type',
                'identification_number',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'username','first_name','last_name'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'go_user'=> [
            'type' => 'info',
            'icon' => 'fa fa-user',
            'href' => '/admin/users/edit/{entry.user_id}'
        ],
        'edit' => [
            'text' => 'visiosoft.module.profile::button.go_profile'
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
