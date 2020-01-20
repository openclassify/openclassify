<?php namespace Visiosoft\ProfileModule\Profile\SignIn;

use Anomaly\UsersModule\User\UserAuthenticator;
use Anomaly\UsersModule\User\UserSecurity;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;


class SignInFormHandler
{
    public function handle(
        SignInFormBuilder $builder,
        UserAuthenticator $authenticator,
        UserSecurity $security,
        Redirector $redirect
    )
    {

        if (!$user = $builder->getUser()) {
            return;
        }

        $response = $security->check($user);

        if ($response instanceof Response) {

            $authenticator->logout($user);

            $builder->setFormResponse($response);

            return;
        }

        $authenticator->login($user, $builder->getFormValue('remember_me'));

        $builder->setFormResponse($redirect->intended($builder->getFormOption('redirect', '/')));
    }
}
