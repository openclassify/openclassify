<?php namespace Visiosoft\AdvsModule\Adv\Event;


class EditAd
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
