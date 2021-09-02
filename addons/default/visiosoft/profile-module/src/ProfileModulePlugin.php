<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\ProfileModule\Adress\Command\GetAddress;
use Visiosoft\ProfileModule\Adress\Command\GetAddressByUser;
use Visiosoft\ProfileModule\Profile\Command\GetProfileDetail;
use Visiosoft\ProfileModule\Profile\Command\GetProfilePhotoURL;

class ProfileModulePlugin extends Plugin
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getAddress',
                function ($id) {

                    if (!$classified = $this->dispatch(new GetAddress($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getAddressByUser',
                function ($user_id) {

                    if (!$classified = $this->dispatch(new GetAddressByUser($user_id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getProfileDetail',
                function ($user_id) {

                    if (!$classified = $this->dispatch(new GetProfileDetail($user_id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'profilePhoto',
                function ($user) {
                    return $this->dispatch(new GetProfilePhotoURL($user));
                }
            ),
        ];
    }
}
