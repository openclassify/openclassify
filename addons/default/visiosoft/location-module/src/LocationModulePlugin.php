<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\LocationModule\City\Command\GetCities;
use Visiosoft\LocationModule\City\Command\GetCity;
use Visiosoft\LocationModule\Country\Command\GetCountries;
use Visiosoft\LocationModule\Country\Command\GetCountry;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\District\Command\GetDistrict;
use Visiosoft\LocationModule\Neighborhood\Command\GetNeighborhood;
use Visiosoft\LocationModule\Village\Command\GetVillage;

class LocationModulePlugin extends Plugin
{


    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getDistrict',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetDistrict($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getNeighborhood',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetNeighborhood($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCity',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetCity($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCities',
                function ($country = null) {

                    if (!$ad = $this->dispatchSync(new GetCities($country))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCountry',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetCountry($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getCountries',
                function () {

                    if (!$ad = $this->dispatchSync(new GetCountries())) {
                        return null;
                    }
                    return $ad;
                }
            ),
            new \Twig_SimpleFunction(
                'getVillage',
                function ($id) {

                    if (!$ad = $this->dispatchSync(new GetVillage($id))) {
                        return null;
                    }

                    return $ad;
                }
            ),

            new \Twig_SimpleFunction(
                'getAllowedCitiesAbv',
                function () {
                    return $this->countryRepository->getAllowedCountriesAbv();
                }
            ),

            new \Twig_SimpleFunction(
                'getDefaultCountry',
                function () {
                    $countryId = setting_value('visiosoft.module.location::default_country') ;
                    $defaultCountry = $this->countryRepository->find($countryId);
                    return $defaultCountry;
                }
            ),

        ];
    }
}
