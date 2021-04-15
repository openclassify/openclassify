<?php namespace Visiosoft\AdvsModule\Adv\Event;

class ChangedStatusAd
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
}

