<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ResetPasswordFormHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ResetPasswordFormHandler
{

    /**
     * Handle the form.
     *
     * @param UserRepositoryInterface  $users
     * @param ResetPasswordFormBuilder $builder
     * @param MessageBag               $messages
     * @param UserPassword             $password
     */
    public function handle(
        UserRepositoryInterface $users,
        ResetPasswordFormBuilder $builder,
        MessageBag $messages,
        UserPassword $password
    ) {
        $user = $users->findByEmail($builder->getEmail());

        /*
         * If we can't find the user by the email
         * provided then head back to the form.
         */
        if (!$user) {

            $messages->error(trans('anomaly.module.users::error.reset_password'));

            return;
        }

        /*
         * If we can't successfully reset the
         * provided user then back back to the form.
         */
        if (!$password->reset($user, $builder->getCode(), $builder->getFormValue('password'))) {

            $messages->error(trans('anomaly.module.users::error.reset_password'));

            return;
        }

        $messages->success(trans('anomaly.module.users::success.reset_password'));
    }
}
