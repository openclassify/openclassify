<?php namespace Visiosoft\LocationModule\District\Events;

class DeletedDistricts
{
    private $districts;

    public function __construct($districts)
    {
        $this->districts = $districts;
    }

    public function getDistricts()
    {
        return $this->districts;
    }
}

