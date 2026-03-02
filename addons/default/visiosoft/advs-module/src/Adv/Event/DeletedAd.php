<?php namespace Visiosoft\AdvsModule\Adv\Event;

class DeletedAd
{
    private $ad;

    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function getAdDetail()
    {
        return $this->ad;
    }

    public function getEntry()
    {
        return $this->ad;
    }
}
