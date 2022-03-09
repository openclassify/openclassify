<?php namespace Anomaly\UsersModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Register\Command\HandleActivateRequest;
use Illuminate\Translation\Translator;

/**
 * Class RegisterController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterController extends PublicController
{

    /**
     * Return the register view.
     *
     * @param  Translator $translator
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function register(Translator $translator)
    {
        $this->template->set(
            'meta_title',
            $translator->trans('anomaly.module.users::breadcrumb.register')
        );

        return $this->view->make('anomaly.module.users::register');
    }

    /**
     * Activate a registered user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate()
    {
        if (!$this->dispatch(new HandleActivateRequest())) {

            $this->messages->error('anomaly.module.users::error.activate_user');

            return $this->redirect->to('/');
        }

        $this->messages->success('anomaly.module.users::success.activate_user');
        $this->messages->success('anomaly.module.users::message.logged_in');

        return $this->redirect->to($this->request->get('redirect', '/'));
    }
}
