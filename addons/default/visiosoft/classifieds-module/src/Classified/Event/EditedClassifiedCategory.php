<?php namespace Visiosoft\ClassifiedsModule\Classified\Event;

class EditedClassifiedCategory
{
    private $classified;
    private $before_editing;

    public function __construct($before_editing_ad_params, $classified)
    {
        $this->classified = $classified;
        $this->before_editing_ad_params = $before_editing_ad_params;
    }

    public function getClassifiedDetail()
    {
        return $this->classified;
    }

    public function getBeforeEditingParams()
    {
        return $this->before_editing_ad_params;
    }
}
