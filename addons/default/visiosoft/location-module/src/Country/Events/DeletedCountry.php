<?php namespace Visiosoft\LocationModule\Country\Events;

class DeletedCountry
{
    private $country;

    public function __construct($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }
}

