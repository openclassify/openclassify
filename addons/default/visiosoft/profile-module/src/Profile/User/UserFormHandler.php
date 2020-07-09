<?php namespace Visiosoft\ProfileModule\Profile\User;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Support\Facades\Auth;
use Visiosoft\NotificationsModule\Notify\Notification\UserUpdateEmailMail;

class UserFormHandler
{
    public function handle(
        UserFormBuilder $builder,
        MessageBag $messages,
        UserModel $userModel
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $data = $builder->getPostData();

        $user = $userModel->find(\auth()->id());
        if ($user->email != $data['email']) {
            $user->notify(new UserUpdateEmailMail());
        }

        $user->update($builder->getPostData());
        $messages->success(trans('visiosoft.module.profile::message.success_update'));
    }
}
