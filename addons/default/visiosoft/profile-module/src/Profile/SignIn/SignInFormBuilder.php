<?php namespace Visiosoft\ProfileModule\Profile\SignIn;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\UserSecurity;
use Symfony\Component\HttpFoundation\Response;

class SignInFormBuilder extends FormBuilder
{
    protected $model = false;

    protected $user = null;

    protected $actions = [
        'blue' => [
            'text' => 'anomaly.module.users::button.login',
        ],
    ];

    protected $options = [
        'redirect'        => '/',
        'breadcrumb'      => false,
        'success_message' => false,
    ];

    public function onPost(UserSecurity $security)
    {
        $response = $security->attempt();

        if ($response instanceof Response) {

            $this->setFormResponse($response);

            $this->setSave(false);
        }
    }

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
