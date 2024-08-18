<?php namespace Anomaly\UsersModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Translation\Translator;

/**
 * Class PasswordController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PasswordController extends PublicController
{

    /**
     * Return a forgot password view.
     *
     * @param  Translator $translator
     */
    public function forgot(Translator $translator)
    {
        $this->template->set(
            'meta_title',
            $translator->trans('anomaly.module.users::breadcrumb.reset_password')
        );

        return $this->view->make('anomaly.module.users::password.forgot');
    }

    /**
     * Reset a user password.
     *
     * @param  Translator $translator
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function reset(Translator $translator)
    {
        $this->template->set(
            'meta_title',
            $translator->trans('anomaly.module.users::breadcrumb.reset_password')
        );

        return $this->view->make('anomaly.module.users::password.reset');
    }
}
