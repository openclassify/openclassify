<?php namespace Visiosoft\AdvsModule\Adv\Event;


class EditAd
{
    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function getAd()
    {
        return $this->ad;
    }
}
