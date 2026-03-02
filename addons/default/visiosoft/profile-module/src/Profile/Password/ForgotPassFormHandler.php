<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Contracts\Config\Repository;
use Visiosoft\ProfileModule\Profile\Events\SendForgotPasswordSms;

class ForgotPassFormHandler
{
    public function handle(
        ForgotPassFormBuilder $builder,
        UserRepositoryInterface $users,
        UserPassword $password,
        MessageBag $messages,
        Repository $config
    )
    {
        if ($builder->hasFormErrors()) {
            return;
        }

        if (!$user = $builder->getUser()) {
            return;
        }

        if ($path = $builder->getFormOption('reset_path')) {
            $config->set('anomaly.module.users::paths.reset', $path);
        }
        if ($builder->getPostData()['resetType'] == "sms") {
            $user = $users->find($user->id);
            $password = rand(000000,999999);
            $user->setAttribute('password', $password);
            $users->save($user);
            if (!is_null($user->gsm_phone)) {
                event(new SendForgotPasswordSms($user, $password));
            } else {
                $messages->error(trans('visiosoft.theme.base::message.found_phone'));
            }
        } else {
            $password->forgot($user);
            try {
                $password->send($user, $builder->getFormOption('reset_redirect'));
                $messages->success(trans('anomaly.module.users::message.confirm_reset_password'));
            } catch (\Exception $err) {
                $messages->error($err->getMessage());
            }
        }
    }
}
