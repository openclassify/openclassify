<?php namespace Visiosoft\ProfileModule\Profile\User;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Support\Facades\Auth;

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

        $userModel->find(Auth::id())
            ->update($builder->getPostData());
        $messages->success(trans('visiosoft.module.profile::message.success_update'));
    }
}
