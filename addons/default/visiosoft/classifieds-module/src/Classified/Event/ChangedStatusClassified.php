<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;

class ChangedStatusClassified
{
    private $classified;

    public function __construct($classified)
    {
        $this->classified = $classified;
    }

    public function getClassifiedDetail()
    {
        return $this->classified;
    }
}

