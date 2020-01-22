<?php namespace Visiosoft\ProfileModule\Profile;

use Visiosoft\ProfileModule\Profile\Contract\ProfileInterface;
use Anomaly\Streams\Platform\Model\Profile\ProfileProfileEntryModel;

class ProfileModel extends ProfileProfileEntryModel implements ProfileInterface
{

    public function getProfile($id = null)
    {
        if($id != null)
        {
            return $this->query()->where('user_id',$id);
        }
        return $this->query();
    }
}
