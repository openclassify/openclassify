<?php namespace Visiosoft\AdvsModule\Adv\Event;

class PriceChange
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
