<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;


class DeletingClassified
{
    protected $entry;

    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    public function getEntry()
    {
        return $this->entry;
    }
}
