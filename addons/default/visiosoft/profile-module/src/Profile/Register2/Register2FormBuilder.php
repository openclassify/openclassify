<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

class Register2FormBuilder extends FormBuilder
{
    protected $roles = [
        'user',
    ];

    protected $model = UserModel::class;

    protected $actions = [
        'blue' => [
            'text' => 'anomaly.module.users::button.register',
        ],
    ];

    protected $options = [
        'redirect' => '/',
        'success_message' => 'anomaly.module.users::success.user_registered',
        'pending_message' => 'anomaly.module.users::message.pending_admin_activation',
        'confirm_message' => 'anomaly.module.users::message.pending_email_activation',
        'activated_message' => 'anomaly.module.users::message.account_activated',
    ];

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
