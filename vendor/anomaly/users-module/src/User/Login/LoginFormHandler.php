<?php namespace Anomaly\UsersModule\User\Login;

use Anomaly\UsersModule\User\UserAuthenticator;
use Anomaly\UsersModule\User\UserSecurity;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFormHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LoginFormHandler
{

    /**
     * Handle the form.
     *
     * @param LoginFormBuilder  $builder
     * @param UserAuthenticator $authenticator
     * @param UserSecurity      $security
     * @param Redirector        $redirect
     */
    public function handle(
        LoginFormBuilder $builder,
        UserAuthenticator $authenticator,
        UserSecurity $security,
        Redirector $redirect
    ) {

        /**
         * If we don't have a user from
         * validation there there is more
         * to do yet! Let the form redirect.
         */
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
