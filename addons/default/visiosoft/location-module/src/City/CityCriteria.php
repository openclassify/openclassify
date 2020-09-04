<?php namespace Visiosoft\LocationModule\City;

use Anomaly\Streams\Platform\Entry\EntryCriteria;

class CityCriteria extends EntryCriteria
{
    public function getSubCities($city) {
        return $this->query->where('parent_country_id', $city)->get();
    }
}
