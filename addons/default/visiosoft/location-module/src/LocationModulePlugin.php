<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\LocationModule\City\Command\GetCity;
use Visiosoft\LocationModule\Country\Command\GetCountry;
use Visiosoft\LocationModule\District\Command\GetDistrict;
use Visiosoft\LocationModule\Neighborhood\Command\GetNeighborhood;

class LocationModulePlugin extends Plugin
{

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getDistrict',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetDistrict($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getNeighborhood',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetNeighborhood($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCity',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetCity($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCountry',
                function ($id) {

                    if (!$ad = $this->dispatch(new GetCountry($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
        ];
    }
}
