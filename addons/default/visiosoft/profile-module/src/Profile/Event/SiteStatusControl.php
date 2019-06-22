<?php namespace Visiosoft\ProfileModule\Profile\Event;


class SiteStatusControl
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
