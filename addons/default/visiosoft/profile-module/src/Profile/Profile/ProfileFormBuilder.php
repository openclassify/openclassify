<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

class ProfileFormBuilder extends FormBuilder
{
    protected $model = UserModel::class;

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_profile'
        ],
    ];
}
