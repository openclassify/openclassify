<?php namespace Visiosoft\LocationModule\City\Events;

class DeletedCities
{
    private $cities;

    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    public function getCities()
    {
        return $this->cities;
    }
}

