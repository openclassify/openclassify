<?php namespace Visiosoft\ProfileModule\Adress\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class AdressTableBuilder extends TableBuilder
{
    protected $filters = [
        'search' => [
            'filter' => 'search',
            'fields' => [
                'adress_name',
            ],
        ],
        'user',
    ];

    protected $columns = [
        'first_name' => 'entry.user.first_name',
        'last_name' => 'entry.user.last_name',
        'adress_name',
        'adress_gsm_phone'
    ];

    protected $buttons = [
        'show' => [
            'type' => 'primary',
            'icon' => 'fa fa-eye',
            'href' => '/admin/profile/adress/edit/{entry.id}',
        ],
    ];

    protected $actions = [
        'delete'
    ];

    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.classifieds::js/admin/filter-user.js',
        ],
        'styles.css' => [
            'visiosoft.module.classifieds::css/admin/filter-user.css',
            'visiosoft.module.classifieds::css/custom.css',
        ],
    ];
}
