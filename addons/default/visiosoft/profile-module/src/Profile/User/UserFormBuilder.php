<?php namespace Visiosoft\ProfileModule\Profile\User;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

class UserFormBuilder extends FormBuilder
{

    protected $model = UserModel::class;

    protected $fields = [
    	'file',
        'first_name' => [
            'required' => true,
        ],
        'last_name' => [
            'required' => true,
        ],
        'email' => [
            'required' => true,
        ],
    ];

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_profile'
        ],
    ];
}
