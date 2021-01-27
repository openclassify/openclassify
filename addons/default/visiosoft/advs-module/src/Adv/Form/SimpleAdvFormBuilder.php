<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\AdvsModule\Adv\AdvModel;

class SimpleAdvFormBuilder extends FormBuilder
{
    protected $model = AdvModel::class;

    protected $fields = [
        "created_by_id" => [
            'label'        => 'visiosoft.module.advs::field.owner',
            'instructions' => 'visiosoft.module.advs::field.default_owner_instruction',
            "type"         => "anomaly.field_type.relationship",
            "config"       => [
                "related" => UserModel::class,
                "mode"    => "lookup",
            ]
        ],
        'name',
        'price',
        'currency',
        'advs_desc',
        'cat1',
        'cat2',
        'cat3',
        'cat4',
        'cat5',
        'cat6',
        'cat7',
        'cat8',
        'cat9',
        'cat10',
        'is_get_adv',
        'stock',
        'files',
    ];

    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.advs::js/simple.js'
        ],
        'styles.css' => [
            'visiosoft.module.advs::css/simple.scss'
        ],
    ];

    protected $options = [
        'wrapper_view' => 'visiosoft.module.advs::blank'
    ];

    protected $buttons = [
        'cancel',
    ];
}
