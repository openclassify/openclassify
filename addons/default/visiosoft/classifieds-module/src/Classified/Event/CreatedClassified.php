<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;

use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;

class CreatedClassified
{
    private $classified;

    public function __construct(ClassifiedModel $classified)
    {
        $this->classified = $classified;
    }

    public function getClassifiedDetail()
    {
        return $this->classified;
    }
}
