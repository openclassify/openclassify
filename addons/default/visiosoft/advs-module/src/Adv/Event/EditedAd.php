<?php namespace Visiosoft\AdvsModule\Adv\Event;

class EditedAd
{
    private $ad;
    private $before_editing;

    public function __construct($before_editing, $ad)
    {
        $this->ad = $ad;
        $this->before_editing = $before_editing;
    }

    public function getAdDetail()
    {
        return $this->ad;
    }

    public function getBeforeEditingDetail()
    {
        return $this->before_editing;
    }
}
