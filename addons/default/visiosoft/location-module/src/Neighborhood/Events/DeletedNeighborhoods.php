<?php namespace Visiosoft\LocationModule\Neighborhood\Events;

class DeletedNeighborhoods
{
    private $neighborhood;

    public function __construct($neighborhood)
    {
        $this->neighborhood = $neighborhood;
    }

    public function getNeighborhoods()
    {
        return $this->neighborhood;
    }
}

