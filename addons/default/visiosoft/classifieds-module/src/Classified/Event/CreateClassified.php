<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;


class CreateClassified
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
