<?php namespace Visiosoft\AdvsModule\Adv;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;

class AdvApiCollection extends AdvRepository
{
    use DispatchesJobs;

    public function getMyAds()
    {
        return $this->model->userAdv()
            ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));
    }

    public function createNewAd(array $params)
    {
        return $this->newQuery()->create($params);
    }

    public function deleteAd(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['ad_id'], $params));

        if (!$ad = $this->newQuery()->find($params['ad_id'])) {
            throw new \Exception(trans('visiosoft.module.advs::message.ad_doesnt_exist'),404);
        }

        if ($ad->created_by_id != Auth::id()) {
            throw new \Exception(trans('visiosoft.module.advs::message.permission_error'),403);
        }

        return $ad->delete();
    }
}
