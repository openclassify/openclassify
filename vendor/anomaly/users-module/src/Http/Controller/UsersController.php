<?php namespace Anomaly\UsersModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class UsersController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UsersController extends PublicController
{

    /**
     * Redirect the current user
     * to their profile route.
     *
     * @param Guard $auth
     * @return \Illuminate\Http\RedirectResponse
     */
    public function self(Guard $auth)
    {
        /* @var UserInterface $user */
        if (!$user = $auth->user()) {
            abort(404);
        }

        return $this->redirect->to($user->route('view'));
    }

    /**
     * View a user profile.
     *
     * @param  UserRepositoryInterface $users
     * @param                          $username
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(UserRepositoryInterface $users, $username)
    {
        if (!$user = $users->findByUsername($username)) {
            abort(404);
        }

        return $this->view->make('anomaly.module.users::users/view', compact('user'));
    }
}
