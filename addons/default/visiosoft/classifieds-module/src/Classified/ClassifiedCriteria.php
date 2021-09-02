<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\RecentlyviewedclassifiedsModule\Recently\RecentlyModel;
use Visiosoft\SubscriptionsModule\User\UserModel;

class ClassifiedCriteria extends EntryCriteria
{

    private $image;
    private $classifiedRepository;

    public function __construct(
        SettingRepositoryInterface $repository,
        Image $image,
        ClassifiedRepositoryInterface $classifiedRepository
    )
    {
        $this->settings = $repository;
        $this->image = $image;
        $this->classifiedRepository = $classifiedRepository;
    }

    public function getClassifiedsModel()
    {
        return new ClassifiedModel();
    }

    public function popularClassifieds()
    {
        $classifiedModel = new ClassifiedModel();
        $popular_classifieds = $classifiedModel->popularClassifieds();
        $classifieds = $classifiedModel->getLocationNames($popular_classifieds);
        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $classifiedModel->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $classifiedModel->AddClassifiedsDefaultCoverImage($classified);
        }
        return $classifieds;
    }

    public function classifiedsofDay()
    {
        $classifiedModel = new ClassifiedModel();
        return $classifiedModel->classifiedsofDay();
    }

    public function latestClassifieds()
    {
        $classifiedModel = new ClassifiedModel();
        $latest_classifieds = ClassifiedModel::query()
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->orderBy('publish_at', 'desc')
            ->paginate($this->settings->value('streams::per_page'));

        $classifieds = $classifiedModel->getLocationNames($latest_classifieds);
        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $classifiedModel->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $classifiedModel->AddClassifiedsDefaultCoverImage($classified);
        }
        return $classifieds;
    }

    public function allClassifieds()
    {
        $classifiedModel = new ClassifiedModel();
        $latest_classifieds = ClassifiedModel::query()
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->paginate($this->settings->value('streams::per_page'));

        $classifieds = $classifiedModel->getLocationNames($latest_classifieds);
        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $classifiedModel->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $classifiedModel->AddClassifiedsDefaultCoverImage($classified);
        }
        return $classifieds;
    }

    public function findClassifiedsByCategoryId($catId, $level = 1, $limit = 20)
    {
        return $this->classifiedRepository->getByCat($catId, $level, $limit);
    }

    public function countClassifiedsByCategoryId($catId, $level = 1)
    {
        return $this->classifiedRepository->getClassifiedsCountByCategory($catId, $level);
    }

    public function getCurrentLocale()
    {
	    return trans('streams::locale.' . config('app.locale') . '.name');
    }

    public function isEnabled($slug)
    {
        $classifiedModel = new ClassifiedModel();
        return $classifiedModel->is_enabled($slug);
    }

    public function getClassifiedById($id)
    {
        $classifiedModel = new ClassifiedModel();
        $classified = $classifiedModel->newQuery()->find($id);
        if ($classified) {
            if (!$classified->cover_photo) {
                $classified->cover_photo = $this->image->make('visiosoft.theme.base::images/no-image.png', 'path')->url();
            } else if (
                !empty($classified->cover_photo) &&
                substr($classified->cover_photo, 0, strlen('/')) !== '/'
            ) {
                $classified->cover_photo = '/' . $classified->cover_photo;
            }
        }
        return $classified;
    }

    public function recentlyViewedClassifieds()
    {
        $classifiedModel = new ClassifiedModel();
        $recentlyModel = new RecentlyModel();
        $recently_viewed_classifieds = $recentlyModel->getRecently();
        $classifieds = $classifiedModel
            ->whereIn('classifieds_classifieds.id', $recently_viewed_classifieds)
            ->get();
        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $classifiedModel->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $classifiedModel->AddClassifiedsDefaultCoverImage($classified);
        }
        return $classifieds;
    }

    public function userSubscriptions()
    {
        $user = UserModel::query()->find(Auth::id());
        return $user->activeSubscriptions();
    }

    public function isOgImage($logo)
    {
        $logo_default = $logo;
        $logo = $this->settings->value('visiosoft.module.classifieds::ogImage');
        if ($logo == null) {
            $logo = $this->settings->value('visiosoft.module.classifieds::logo');
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
