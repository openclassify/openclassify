<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\RecentlyviewedadsModule\Recently\RecentlyModel;
use Visiosoft\SubscriptionsModule\User\UserModel;

class AdvCriteria extends EntryCriteria
{

    private $image;
    private $advRepository;

    public function __construct(
        SettingRepositoryInterface $repository,
        Image $image,
        AdvRepositoryInterface $advRepository
    )
    {
        $this->settings = $repository;
        $this->image = $image;
        $this->advRepository = $advRepository;
    }

    public function getAdvsModel()
    {
        return new AdvModel();
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
            ->paginate($this->settings->value('streams::per_page'));

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
            ->paginate($this->settings->value('streams::per_page'));

        $ads = $advModel->getLocationNames($latest_advs);
        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return $ads;
    }

    public function findAdsByCategoryId($catId, $level = 1, $limit = 20)
    {
        return $this->advRepository->getByCat($catId, $level, $limit);
    }

    public function countAdsByCategoryId($catId, $level = 1)
    {
        return $this->advRepository->getAdsCountByCategory($catId, $level);
    }

    public function getCurrentLocale()
    {
	    return trans('streams::locale.' . config('app.locale') . '.name');
    }

    public function isEnabled($slug)
    {
        $advModel = new AdvModel();
        return $advModel->is_enabled($slug);
    }

    public function getAdvById($id)
    {
        $advModel = new AdvModel();
        $adv = $advModel->newQuery()->find($id);
        if ($adv) {
            if (!$adv->cover_photo) {
                $adv->cover_photo = $this->image->make('visiosoft.theme.base::images/no-image.png', 'path')->url();
            } else if (
                !empty($adv->cover_photo) &&
                substr($adv->cover_photo, 0, strlen('/')) !== '/'
            ) {
                $adv->cover_photo = '/' . $adv->cover_photo;
            }
        }
        return $adv;
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
