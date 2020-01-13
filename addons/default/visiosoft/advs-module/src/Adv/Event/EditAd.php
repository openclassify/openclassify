<?php namespace Visiosoft\AdvsModule\Adv\Event;


class EditAd
{
    public function __construct($request, $settings, $adv)
    {
        $this->request = $request;
        $this->settings = $settings;
        $this->adv = $adv;
    }

    public function getRequest()
    {
        return $this;
    }
}
