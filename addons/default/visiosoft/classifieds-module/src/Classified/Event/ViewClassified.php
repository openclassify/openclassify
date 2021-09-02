<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;


class ViewClassified
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
