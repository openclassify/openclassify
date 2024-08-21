<?php namespace Visiosoft\RestateTheme\Profile\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

class ProfileFormBuilder extends FormBuilder
{
    protected $model = UserModel::class;

    protected $fields = [
        'first_name',
        'last_name',
        'email',
        'gsm_phone',
        'office_phone',
        'land_phone',
        'file',
    ];

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_profile'
        ],
    ];
}
