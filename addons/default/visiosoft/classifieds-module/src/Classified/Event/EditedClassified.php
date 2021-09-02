<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;

class EditedClassified
{
    private $classified;
    private $before_editing;

    public function __construct($before_editing, $classified)
    {
        $this->classified = $classified;
        $this->before_editing = $before_editing;
    }

    public function getClassifiedDetail()
    {
        return $this->classified;
    }

    public function getBeforeEditingDetail()
    {
        return $this->before_editing;
    }
}
