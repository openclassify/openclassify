<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;


class EditClassified
{
    public function __construct($classified)
    {
        $this->classified = $classified;
    }

    public function getClassified()
    {
        return $this->classified;
    }
}
