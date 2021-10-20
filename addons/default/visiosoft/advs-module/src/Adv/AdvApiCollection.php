<?php namespace Visiosoft\AdvsModule\Adv;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;

class AdvApiCollection extends AdvRepository
{
    use DispatchesJobs;

    public function getMyAds()
    {
        return $this->currentAds()
            ->where('created_by_id', Auth::id());
    }

    public function getMyExpiredAds()
    {
        return $this->expiredAds()
            ->where('created_by_id', Auth::id());
    }

    public function createNewAd(array $params)
    {
        return $this->newQuery()->create($params);
    }

    public function deleteAd(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['ad_id'], $params));


        $ad = $this->checkAd($params['ad_id']);

        $this->checkOwner($ad);

        return $ad->delete();
    }

    public function updateAd(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['ad_id'], $params));

        $ad = $this->checkAd($params['ad_id']);

        $this->checkOwner($ad);

        unset($params['ad_id'], $params['id'], $params['created_at'], $params['updated_at'],
            $params['deleted_at'], $params['created_by_id'], $params['updated_by_id']);


        $update_params = [
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ];

        $ad->update(array_merge($update_params, $params));

        return $ad;
    }

    public function getAds()
    {
        return $this->currentAds();
    }

    public function checkAd($id)
    {
        if (!$ad = $this->newQuery()->find($id)) {
            throw new \Exception(trans('visiosoft.module.advs::message.ad_doesnt_exist'), 404);
            die;
        }
        return $ad;
    }

    public function checkOwner($ad)
    {
        if ($ad->created_by_id != Auth::id()) {
            throw new \Exception(trans('visiosoft.module.advs::message.permission_error'), 403);
            die;
        }
    }
}
