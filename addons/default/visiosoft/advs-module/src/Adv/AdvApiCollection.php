<?php namespace Visiosoft\AdvsModule\Adv;

class AdvApiCollection extends AdvRepository
{
    public function getMyAds()
    {
        return $this->model->userAdv()
            ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));

    }
}
