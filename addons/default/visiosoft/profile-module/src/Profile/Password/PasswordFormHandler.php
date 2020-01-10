<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModule\User\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordFormHandler
{
    public function handle(
        PasswordFormBuilder $builder,
        MessageBag $messages,
        UserModel $userModel,
        UserPassword $userPassword

    )
    {
        $errorList = array();

        if (!$builder->canSave()) {
            return;
        }

        if (!$builder->getPostValue('confirm_password')) {
            $messages->error(trans('visiosoft.module.profile::message.please_confirm_transaction'));
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

        $userModel->find(Auth::id())
            ->update([
                'password' => Hash::make($builder->getPostValue('new_password'))
            ]);
        $messages->success(trans('visiosoft.module.profile::message.your_password_changed'));
    }
}
