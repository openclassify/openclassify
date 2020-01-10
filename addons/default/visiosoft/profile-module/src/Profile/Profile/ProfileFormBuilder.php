<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Profile\ProfileModel;


class ProfileFormBuilder extends FormBuilder
{

    protected $model = ProfileModel::class;

    protected $fields = [
        'file',
        'gsm_phone',
        'office_phone',
        'land_phone',
        'adv_listing_banner',
        'identification_number',
        'register_type'
    ];

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_profile'
        ],
    ];
}
