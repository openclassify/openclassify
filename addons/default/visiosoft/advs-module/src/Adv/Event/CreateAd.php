<?php namespace Visiosoft\AdvsModule\Adv\Event;


class CreateAd
{
    public function __construct($request,$settings)
    {
        $this->request = $request;
        $this->settings = $settings;
    }

    public function getRequest()
    {
        return $this;
    }
}
