<?php

namespace Anomaly\UsersModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection;
use Anomaly\UsersModule\User\Login\LoginFormBuilder;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Redirector;

/**
 * Class LoginController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LoginController extends PublicController
{

    /**
     * Return the admin login form.
     *
     * @param  LoginFormBuilder $form
     * @param  Redirector $redirect
     * @param  Guard $auth
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(
        NavigationCollection $navigation,
        LoginFormBuilder $form,
        Redirector $redirect,
        Guard $auth
    ) {
        /*
         * If we're already logged in
         * proceed to the dashboard.
         *
         * Replace this later with a
         * configurable landing page.
         */
        if ($auth->check() && $home = $navigation->first()) {
            return $redirect->to($home->getHref());
        }

        return $form
            ->setOption('redirect', 'admin')
            ->setOption('wrapper_view', 'theme::login')
            ->render();
    }

    /**
     * Log the user out.
     *
     * @param  UserAuthenticator $authenticator
     * @param  Guard $auth
     * @return \Illuminate\Http\RedirectResponse|Redirector
     */
    public function logout(UserAuthenticator $authenticator, Guard $auth)
    {
        if (!$auth->guest()) {
            $authenticator->logout();
        }

        $this->messages->success('anomaly.module.users::message.logged_out');

        return redirect('admin/login');
    }
}
