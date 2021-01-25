<?php namespace Visiosoft\LocationModule\City;

use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;

class CityCriteria extends EntryCriteria
{
    public function getCitiesByCountryId($country_id) {
        $city_repository = app(CityRepositoryInterface::class);
        return $city_repository->getCitiesByCountryId($country_id);
    }
}
