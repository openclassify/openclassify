<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\AdvsModule\Adv\Command\GetAd;

class AdvsModulePlugin extends Plugin
{

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'adDetail',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetAd($id))) {
                        return null;
                    }

                    return $ad;
                }
            )
        ];
    }
}
