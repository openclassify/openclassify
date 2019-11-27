<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\AdvsModule\Adv\Command\GetAd;
use Visiosoft\AdvsModule\Adv\Command\isActive;
use Visiosoft\AdvsModule\Adv\Command\LatestAds;

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
            ), new \Twig_SimpleFunction(
                'isActive',
                function ($name, $type = 'module', $project = 'visiosoft') {

                    if (!$isActive = $this->dispatch(new isActive($name, $type, $project))) {
                        return 0;
                    }

                    return $isActive;
                }
            ), new \Twig_SimpleFunction(
                'latestAds',
                function () {

                    if (!$latestAds = $this->dispatch(new LatestAds())) {
                        return 0;
                    }

                    return $latestAds;
                }
            )
        ];
    }
}
