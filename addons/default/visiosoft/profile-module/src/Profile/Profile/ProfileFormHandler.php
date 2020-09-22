<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\ProfileModule\Events\UserUpdated;

class ProfileFormHandler
{
    public function handle(
        ProfileFormBuilder $builder,
        MessageBag $messages,
        UserModel $userModel
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $parameters = [
            'gsm_phone' => $builder->getPostValue('gsm_phone'),
            'office_phone' => $builder->getPostValue('office_phone'),
            'land_phone' => $builder->getPostValue('land_phone'),
            'identification_number' => $builder->getPostValue('identification_number'),
            'register_type' => $builder->getPostValue('register_type'),
        ];

        if ($builder->getPostValue('file') != null) {
            $parameters['file_id'] = $builder->getPostValue('file');
        } elseif (empty($builder->getPostValue('file'))) {
            $parameters['file_id'] = null;
        }

        $user = $userModel->newQuery()->find(\auth()->id());

        $oldCustomerInfo = $user->toArray();

        $changes = $this->change($user, $parameters);

        event(new UserUpdated($oldCustomerInfo, $changes));

        $messages->success(trans('visiosoft.module.profile::message.success_update'));
    }

    public function change($user, $data)
    {
        $user->fill($data);
        $changes = $user->getDirty();
        $user->save();
        if (!count($changes)) {
            return false;
        }
        return $changes;
    }
}
