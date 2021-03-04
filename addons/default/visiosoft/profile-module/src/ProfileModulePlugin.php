<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\ProfileModule\Adress\Command\GetAddress;
use Visiosoft\ProfileModule\Adress\Command\GetAddressByUser;
use Visiosoft\ProfileModule\Profile\Command\GetProfileDetail;

class ProfileModulePlugin extends Plugin
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getAddress',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetAddress($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getAddressByUser',
                function ($user_id) {

                    if (!$ad = $this->dispatch(new GetAddressByUser($user_id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getProfileDetail',
                function ($user_id) {

                    if (!$ad = $this->dispatch(new GetProfileDetail($user_id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
        ];
    }
}
