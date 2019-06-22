<?php namespace Visiosoft\AdvsModule\Adv\Event;


class viewAd
{
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this;
    }
}
