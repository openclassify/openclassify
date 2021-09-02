<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;

class DeletedClassified
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

    public function getEntry()
    {
        return $this->classified;
    }
}
