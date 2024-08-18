<?php namespace Anomaly\UsersModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Translation\Translator;

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
     * Return the login form.
     *
     * @param  Translator $translator
     * @param Guard $auth
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Translator $translator, Guard $auth)
    {
        if ($auth->check()) {
            return $this->redirect->to($this->request->get('redirect', '/'));
        }

        $this->template->set(
            'meta_title',
            $translator->trans('anomaly.module.users::breadcrumb.login')
        );

        return $this->view->make('anomaly.module.users::login');
    }

    /**
     * Logout the active user.
     *
     * @param  UserAuthenticator $authenticator
     * @param  Guard $auth
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(UserAuthenticator $authenticator, Guard $auth, UrlGenerator $url)
    {
        if (!$auth->guest()) {
            $authenticator->logout();
        }

        $this->messages->success($this->request->get('message', 'anomaly.module.users::message.logged_out'));

        return $this->response->redirectTo($this->url->to($this->request->get('redirect', '/')));
    }
}
