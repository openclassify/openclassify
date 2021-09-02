<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\LocationModule\City\Command\GetCities;
use Visiosoft\LocationModule\City\Command\GetCity;
use Visiosoft\LocationModule\Country\Command\GetCountries;
use Visiosoft\LocationModule\Country\Command\GetCountry;
use Visiosoft\LocationModule\District\Command\GetDistrict;
use Visiosoft\LocationModule\Neighborhood\Command\GetNeighborhood;
use Visiosoft\LocationModule\Village\Command\GetVillage;

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

                    if (!$classified = $this->dispatch(new GetDistrict($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getNeighborhood',
                function ($id) {

                    if (!$classified = $this->dispatch(new GetNeighborhood($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getCity',
                function ($id) {

                    if (!$classified = $this->dispatch(new GetCity($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getCities',
                function ($country = null) {

                    if (!$classified = $this->dispatch(new GetCities($country))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getCountry',
                function ($id) {

                    if (!$classified = $this->dispatch(new GetCountry($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getCountries',
                function () {

                    if (!$classified = $this->dispatch(new GetCountries())) {
                        return null;
                    }
                    return $classified;
                }
            ),
            new \Twig_SimpleFunction(
                'getVillage',
                function ($id) {

                    if (!$classified = $this->dispatch(new GetVillage($id))) {
                        return null;
                    }

                    return $classified;
                }
            ),
        ];
    }
}
