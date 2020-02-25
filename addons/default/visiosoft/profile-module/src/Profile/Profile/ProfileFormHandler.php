<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Message\MessageBag;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ProfileModule\Profile\ProfileModel;

class ProfileFormHandler
{
    public function handle(
        ProfileFormBuilder $builder,
        MessageBag $messages,
        ProfileModel $profileModel
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $parameters = [
            'gsm_phone' => $builder->getPostValue('full_phone_gsm_phone'),
            'office_phone' => $builder->getPostValue('full_phone_office_phone'),
            'land_phone' => $builder->getPostValue('full_phone_land_phone'),
            'identification_number' => $builder->getPostValue('identification_number'),
            'register_type' => $builder->getPostValue('register_type'),
            'adv_listing_banner_id' => $builder->getPostValue('adv_listing_banner'),
        ];

        if ($builder->getPostValue('file') != null)
            $parameters['file_id'] = $builder->getPostValue('file');


        $profileModel->where('user_id', Auth::id())
            ->update($parameters);

        $messages->success(trans('visiosoft.module.profile::message.success_update'));
    }
}
