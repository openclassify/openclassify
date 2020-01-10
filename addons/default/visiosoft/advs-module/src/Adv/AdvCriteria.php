<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Illuminate\Support\Facades\Auth;
use Visiosoft\RecentlyviewedadsModule\Recently\RecentlyModel;
use Visiosoft\SubscriptionsModule\User\UserModel;

class AdvCriteria extends EntryCriteria
{

    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->settings = $repository;
    }

    public function popularAdvs()
    {
        $advModel = new AdvModel();
        $popular_advs = $advModel->popularAdvs();
        $ads = $advModel->getLocationNames($popular_advs);
        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return $ads;
    }


    public function advsofDay()
    {
        $advModel = new AdvModel();
        return $advModel->advsofDay();
    }

    public function latestAdvs()
    {
        $advModel = new AdvModel();
        $latest_advs = AdvModel::query()
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->orderBy('publish_at', 'desc')
            ->paginate($this->settings->value('visiosoft.theme.base::s-type-latest-limit'));

        $ads = $advModel->getLocationNames($latest_advs);
        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return $ads;
    }

    public function allAdvs()
    {
        $advModel = new AdvModel();
        $latest_advs = AdvModel::query()
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->paginate($this->settings->value('visiosoft.theme.base::s-type-latest-limit'));

        $ads = $advModel->getLocationNames($latest_advs);
        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return $ads;
    }

    public function getCurrentLocale()
    {
        return locale_get_display_name(config('app.locale'));
    }

    public function isEnabled($slug)
    {
        $advModel = new AdvModel();
        return $advModel->is_enabled($slug);
    }

    public function recentlyViewedAds()
    {
        $advModel = new AdvModel();
        $recentlyModel = new RecentlyModel();
        $recently_viewed_ads = $recentlyModel->getRecently();
        $ads = $advModel
            ->whereIn('advs_advs.id', $recently_viewed_ads)
            ->get();
        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return $ads;
    }

    public function userSubscriptions()
    {
        $user = UserModel::query()->find(Auth::id());
        return $user->activeSubscriptions();
    }

    public function isOgImage($logo)
    {
        $logo_default = $logo;
        $logo = $this->settings->value('visiosoft.module.advs::ogImage');
        if ($logo == null) {
            $logo = $this->settings->value('visiosoft.module.advs::logo');
            if ($logo == null) {
                $logo = $logo_default;
            }
        }
        return $logo;
    }

    public function Flags()
    {
        $addonCollection = app(AddonCollection::class);
        $dir = $addonCollection->themes->active('standard')->getPath('resources')."/images/flags";
        $dh  = opendir($dir);
        while (false !== ($filename = readdir($dh))) {
            $files[] = $filename;
        }
        $images=preg_grep ('/\.png$/i', $files);
        $images=preg_replace('/\\.[^.\\s]{3,4}$/', '', $images);
        return $images;
    }

}
