<?php namespace Visiosoft\ProfileModule\Profile;

use Anomaly\Streams\Platform\Entry\EntryPresenter;

class ProfilePresenter extends EntryPresenter
{
    public function getNotification($type) {
        $value = $this->object->$type;
        if ($value == 1) {
            return "checked";
        }
    }
}
