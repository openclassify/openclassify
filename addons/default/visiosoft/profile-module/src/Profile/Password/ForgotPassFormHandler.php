<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Contracts\Config\Repository;

class ForgotPassFormHandler
{

    /**
     * Handle the form.
     *
     * @param ForgotPassFormBuilder $builder
     * @param UserRepositoryInterface   $users
     * @param UserPassword              $password
     * @param MessageBag                $messages
     * @param Repository                $config
     */
    public function handle(
        ForgotPassFormBuilder $builder,
        UserRepositoryInterface $users,
        UserPassword $password,
        MessageBag $messages,
        Repository $config
    ) {
        if ($builder->hasFormErrors()) {
            return;
        }

        if (!$user = $builder->getUser()) {
            return;
        }

        if ($path = $builder->getFormOption('reset_path')) {
            $config->set('anomaly.module.users::paths.reset', $path);
        }

        $password->forgot($user);
        $password->send($user, $builder->getFormOption('reset_redirect'));

        $messages->success($builder->getFormOption('success_message'));
    }
}
