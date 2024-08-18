<?php namespace Visiosoft\AdvsModule\Adv\Event;

class EditedAdCategory
{
    private $ad;
    private $before_editing;

    public function __construct($before_editing_ad_params, $ad)
    {
        $this->ad = $ad;
        $this->before_editing_ad_params = $before_editing_ad_params;
    }

    public function getAdDetail()
    {
        return $this->ad;
    }

    public function getBeforeEditingParams()
    {
        return $this->before_editing_ad_params;
    }
}
