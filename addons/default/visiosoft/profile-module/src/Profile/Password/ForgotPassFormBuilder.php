<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;

class ForgotPassFormBuilder extends FormBuilder
{
    protected $user = null;

    protected $model = false;

    protected $actions = [
        'submit',
    ];

    protected $options = [
        'redirect'        => '/',
    ];

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}