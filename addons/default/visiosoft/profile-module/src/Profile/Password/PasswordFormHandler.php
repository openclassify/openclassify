<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\User;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Visiosoft\ProfileModule\Events\PasswordChanged;

class PasswordFormHandler
{
    public function handle(
        PasswordFormBuilder $builder,
        MessageBag $messages,
        UserPassword $userPassword

    )
    {
        $errorList = array();

        if (!$builder->canSave()) {
            return;
        }

        if (!Hash::check($builder->getPostValue('old_password'), \auth()->user()->password)) {
            $messages->error(trans('visiosoft.module.profile::message.wrong_password'));
            return redirect()->back();
        }

        if ($builder->getPostValue('new_password') != $builder->getPostValue('re_new_password')) {
            $messages->error(trans('visiosoft.module.profile::message.password_do_not_match'));
            return redirect()->back();
        }
        $validator = $userPassword->validate($builder->getPostValue('new_password'));
        foreach ($validator->errors()->all() as $error) {
            $errorList[] = $error;
        }

        if (count($errorList) != 0) {
            $messages->error($errorList);
            return redirect()->back();
        }

        $user = User::query()->find(Auth::id());
        $user->setAttribute('password', $builder->getPostValue('new_password'));
        $user->save($user->toArray());

        event(new PasswordChanged());

        $messages->success(trans('visiosoft.module.profile::message.your_password_changed'));
    }
}
