<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\MediaFieldType\Http\Controller\UploadController;

class AdvRepository extends EntryRepository implements AdvRepositoryInterface
{
    protected $model;
    private $fileRepository;
    private $folderRepository;

    public function __construct(
        AdvModel $model,
        FileRepositoryInterface $fileRepository,
        FolderRepositoryInterface $folderRepository
    )
    {
        $this->model = $model;
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $folderRepository;
    }

    public function searchAdvs(
        $type, $param = null, $customParameters = [],
        $limit = null, $category = null, $city = null, $paginate = true
    )
    {
        $isSort = !empty($param['sort_by']);
        $isActiveDopings = new AdvModel();
        $isActiveDopings = $isActiveDopings->is_enabled('dopings');

        $query = $this->model;
        $query = $query->where('advs_advs.slug', '!=', "");
        $query = $query->where('advs_advs.status', 'approved');
        $query = $query->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));


        $query = $query->leftJoin('advs_advs_translations', function ($join) {
            $join->on('advs_advs.id', '=', 'advs_advs_translations.entry_id');
            $join->where('advs_advs_translations.locale', '=', Request()->session()->get('_locale', setting_value('streams::default_locale')));
        });

        if (!empty($param['keyword'])) {
            if (is_numeric($param['keyword'])) {
                $query = $query->where('advs_advs.id', $param['keyword']);
            } else {
                $delimiter = '_';
                $keyword = str_slug($param['keyword'], $delimiter);
                $query = $query->where(function ($query) use ($keyword) {
                    $query->where('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('advs_advs_translations.name', 'like', '%' . $keyword . '%');
                });
            }
        }
        if (!setting_value('visiosoft.module.location::hide_location_filter')) {
            $country = !empty($param['country']) ? $param['country'] : setting_value('visiosoft.module.location::default_country');
            if ($country) {
                $query = $query->where('country_id', $country);
            }
            if ($city) {
                $query = $query->where('city', $city->id);
            } elseif (isset($param['city']) and !empty(array_filter($param['city']))) {
                $query = $query->whereIn('city', explode(',', array_first($param['city'])));
            }
            if (isset($param['district']) and !empty(array_filter($param['district']))) {
                $query = $query->whereIn('district', explode(',', array_first($param['district'])));
            }
            if (isset($param['neighborhood']) and !empty(array_filter($param['neighborhood']))) {
                $query = $query->whereIn('neighborhood', explode(',', array_first($param['neighborhood'])));
            }
            if (isset($param['village']) and !empty(array_filter($param['village']))) {
                $query = $query->whereIn('village', explode(',', array_first($param['village'])));
            }
        }
        if ($category) {
            $category_repository = app(CategoryRepositoryInterface::class);

            $catLevel = $category_repository->getLevelById($category->id);
            $catLevel = "cat" . $catLevel;
            $query = $query->where($catLevel, $category->id);
        }
        if (!empty($param['user'])) {
            $query = $query->where('advs_advs.created_by_id', $param['user']);
        }
        $currency = setting_value('streams::currency');

        if (!empty($param['currency'])) {
            $currency = $param['currency'];
        }

        if (!empty($param['min_price'])) {
            $num = $param['min_price'];
            $int = (int)$num;
            $column = "JSON_EXTRACT(foreign_currencies, '$." . $currency . "') >= " . $int;
            $query = $query->whereRaw($column);
        }

        if (!empty($param['max_price'])) {
            $num = $param['max_price'];
            $int = (int)$num;
            $column = "JSON_EXTRACT(foreign_currencies, '$." . $currency . "') <= " . $int;
            $query = $query->whereRaw($column);
        }

        if (!empty($param['date'])) {
            if ($param['date'] === 'day') {
                $query = $query->where('advs_advs.publish_at', '>=', Carbon::now()->subDay());
            } elseif ($param['date'] === 'two_days') {
                $query = $query->where('advs_advs.publish_at', '>=', Carbon::now()->subDays(2));
            } elseif ($param['date'] === 'week') {
                $query = $query->where('advs_advs.publish_at', '>=', Carbon::now()->subWeek());
            } elseif ($param['date'] === 'month') {
                $query = $query->where('advs_advs.publish_at', '>=', Carbon::now()->subMonth());
            }
        }
        if (!empty($param['photo'])) {
            $query = $query->whereNotNull('cover_photo');
        }
        if (!empty($param['video'])) {
            $query = $query->where('cover_photo', 'like', '%video/upload/w_400,e_loop%');
        }
        if (!empty($param['map']) && $param['map'] == true) {
            $query = $query->whereNotNull('map_Val');
        }
        if (!empty($param['get_ads']) && $param['get_ads'] == true) {
            $query = $query->where('is_get_adv', 1);
        }

        if (!empty($param['created_at'])) {
            $query = $query->whereDate('advs_advs.created_at', $param['created_at']);
        }

        if (!empty($param['start_publish_at']) && !empty($param['finish_publish_at'])) {
            $query = $query->whereBetween('advs_advs.publish_at', [Carbon::make($param['start_publish_at'] . " 23:59"), Carbon::make($param['finish_publish_at'] . " 00:00")]);
        }

        foreach ($param as $para => $value) {
            if (substr($para, 0, 3) === "cf_") {
                $id = substr($para, 3);
                $customParameters[] = ['id' => "$.cf" . $id, 'value' => $param[$para]];
            }
        }

        if ($this->model->is_enabled('customfields')) {
            $query = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->filterSearch($customParameters, $param, $query);
        }

//        //UPDATE `default_advs_advs` SET `coor` = (PointFromText('POINT(41.085022 28.804754)')) WHERE `default_advs_advs`.`id` = 8
//        //SELECT * FROM `default_advs_advs` WHERE ST_DISTANCE(ST_GeomFromText('POINT(41.0709052 28.829627)'), coor) < 20

        if (!empty($param['dlong']) && !empty($param['dlat']) && !empty($param['distance'])) {
            $query = $query->whereNotNull('coor');
            $query = $query->whereRaw("ST_DISTANCE(ST_GeomFromText('POINT(" . $param['dlong'] . " " . $param['dlat'] . ")'), coor) < " . $param['distance']);
        }

        if ($isActiveDopings && !$isSort) {
            $query = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')->search($query, $param);
        }

        if ($isSort) {
            switch ($param['sort_by']) {
                case "popular":
                    $query = $query->orderBy('advs_advs.count_show_ad', 'desc');
                    break;
                case "sort_price_up":
                    $query = $query->orderBy('advs_advs.price', 'desc');
                    break;
                case "sort_price_down":
                    $query = $query->orderBy('advs_advs.price', 'asc');
                    break;
                case "sort_time_newest":
                    $query = $query->orderBy('advs_advs.publish_at', 'desc');
                    break;
                case "sort_time_oldest":
                    $query = $query->orderBy('advs_advs.publish_at', 'asc');
                    break;
                case "address_a_z":
                    $query = $query->join('location_cities_translations', 'advs_advs.city', '=', 'location_cities_translations.entry_id')
                        ->orderBy('location_cities_translations.name', 'ASC');
                    break;
                case "address_z_a":
                    $query = $query->join('location_cities_translations', 'advs_advs.city', '=', 'location_cities_translations.entry_id')
                        ->orderBy('location_cities_translations.name', 'DESC');
                    break;
                case "name_z_a":
                    $query = $query->orderBy('advs_advs_translations.name', 'DESC');
                    break;
                case "name_a_z":
                    $query = $query->orderBy('advs_advs_translations.name', 'ASC');
                    break;
            }
        } else {
            $query = $query->orderBy('advs_advs.created_at', 'desc');
        }

        if ($isActiveDopings && !$isSort) {
            $query = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')->querySelect($query, $param);
        } else {
            $query = $query->select('advs_advs.*', 'advs_advs_translations.name as name',
                'advs_advs_translations.advs_desc as advs_desc');
        }

        if ($type == "list") {
            return $paginate ? $query->paginate(setting_value('streams::per_page')) : $query;
        } else {
            return $query->get();
        }
    }

    public function softDeleteAdv($id)
    {
        return $this->find($id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function getLocationNames($adv)
    {
        $country = CountryModel::query()->where('location_countries.id', $adv->country_id)->first();
        $city = CityModel::query()->where('location_cities.id', $adv->city)->first();
        $district = DistrictModel::query()->where('location_districts.id', $adv->district)->first();
        if ($country != null) {
            $adv->setAttribute('country_name', $country->name);
        }
        if ($city != null) {
            $adv->setAttribute('city_name', $city->name);
        }
        if ($district != null) {
            $adv->setAttribute('district_name', $district->name);
        }
        return $adv;
    }

    public function getCatNames($adv)
    {
        $cat1 = CategoryModel::query()->where('cats_category.id', $adv->cat1)->first();
        $cat2 = CategoryModel::query()->where('cats_category.id', $adv->cat2)->first();

        if (!is_null($cat1))
            $adv->setAttribute('cat1_name', $cat1->name);
        else
            $adv->setAttribute('cat1_name', "");

        if (!is_null($cat2))
            $adv->setAttribute('cat2_name', $cat2->name);

        else
            $adv->setAttribute('cat2_name', "");


        return $adv;
    }

    public function findByIDAndSlug($id, $slug)
    {
        $adv = $this->newQuery()
            ->where('advs_advs.id', $id)
            ->where('slug', $slug)
            ->first();

        if ($adv) {
            $adv = $this->getLocationNames($adv);
        }

        return $adv;
    }

    public function getListItemAdv($id)
    {
        $adv = $this->model
            ->where('advs_advs.id', $id)
            ->leftJoin('users_users as u1', 'advs_advs.created_by_id', '=', 'u1.id')
            ->select('advs_advs.*', 'u1.first_name as first_name', 'u1.last_name as last_name', 'u1.id as owner_id')
            ->first();

        if ($adv) {
            $adv = $this->getLocationNames($adv);
        }

        return $adv;
    }

    public function addAttributes($advs)
    {
        foreach ($advs as $adv) {
            $adv = $this->getLocationNames($adv);
            $adv = $this->getCatNames($adv);
        }

        return $advs;
    }

    public function cover_image_update($adv)
    {
        if (count($adv->files) != 0) {
            $fileName = $adv->files[0]->name;
            $ext = explode('.', $fileName);
            if ($ext[1] != 'svg') {
                $fileName = 'tn-' . $fileName;
            }

            $folder = $this->folderRepository->findBySlug('images');
            $thumbnail = $this->fileRepository->findByNameAndFolder($fileName, $folder);

            if (!$thumbnail AND $ext[1] != 'svg') {

                // Create thumbnail image

                $arrContextOptions = array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );

                $url = preg_replace_callback('#://([^/]+)/([^?]+)#', function ($match) {
                    return '://' . $match[1] . '/' . join('/', array_map('rawurlencode', explode('/', $match[2])));
                }, $adv->files[0]->make()->url());

                $image = Image::make(file_get_contents($url, false, stream_context_create($arrContextOptions)));
                $image->resize(
                    null,
                    setting_value('visiosoft.module.advs::thumbnail_height'),
                    function ($constraint) {
                        $constraint->aspectRatio();
                    });
                if (setting_value('visiosoft.module.advs::add_canvas')) {
                    $image->resizeCanvas(
                        setting_value('visiosoft.module.advs::thumbnail_width'),
                        setting_value('visiosoft.module.advs::thumbnail_height'),
                        'center', false, 'fff'
                    );
                }
                $fileName = 'tn-' . $adv->files[0]->name;
                $image->save(app_storage_path() . '/files-module/local/images/' . $fileName);

                // Create file entry for the image
                $this->fileRepository->create([
                    'folder_id' => $folder->getId(),
                    'name' => $fileName,
                    'disk_id' => 1,
                    'size' => $image->filesize(),
                    'mime_type' => $image->mime,
                    'extension' => $image->extension,
                ]);

            }
            $coverPhoto = 'files/images/' . $fileName;
        } else {
            $coverPhoto = null;
        }
        $adv->update(['cover_photo' => $coverPhoto]);
    }

    public function getRecommendedAds($id)
    {
        return AdvModel::query()
            ->where('advs_advs.id', '!=', $id)
            ->where('advs_advs.status', 'approved')
            ->select('advs_advs.*')
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
    }

    public function getLastAd($id)
    {
        return AdvsAdvsEntryModel::query()->where('advs_advs.created_by_id', '=', $id)->max('id');
    }

    public function getAdvArray($id)
    {
        $ad = AdvsAdvsEntryModel::query()->where('advs_advs.id', $id)->first();

        return ($ad !== null) ? $ad->toArray() : null;
    }

    public function getQuantity($quantity, $type, $item)
    {
        if ($type == "minus") {
            return $quantity - 1;
        } elseif ($type == "plus") {
            return $quantity + 1;
        } else {
            return $quantity;
        }
    }

    public function findByIds($ids)
    {
        return $this->model->orderBy('created_at', 'DESC')->whereIn('advs_advs.id', $ids)->get();
    }

    public function hideAdsWithoutOutOfStock($ads)
    {
        return $ads->filter(
            function ($entry) {
                return (($entry->is_get_adv == true && $entry->stock > 0) || ($entry->is_get_adv == false));
            }
        );
    }

    /**
     * Get Latest Ads
     * @return mixed
     */
    public function latestAds()
    {
        $latest_advs = $this->model->currentAds()
            ->limit(setting_value('visiosoft.module.advs::latest-limit'))
            ->get();

        if (setting_value('visiosoft.module.advs::hide_out_of_stock_products_without_listing')) {
            $latest_advs = $this->hideAdsWithoutOutOfStock($latest_advs);
        }

        return $this->model->getLocationNames($latest_advs);
    }

    public function latestAdsWithout($keyword, $value)
    {
        $latest_ads = $this->model->currentAds()
            ->where(function ($q) use ($keyword, $value) {
                return $q->where($keyword, '<>', $value);
            })
            ->limit(setting_value('visiosoft.module.advs::latest-limit'))
            ->get();

        if (setting_value('visiosoft.module.advs::hide_out_of_stock_products_without_listing')) {
            $latest_ads = $this->hideAdsWithoutOutOfStock($latest_ads);
        }

        return $this->model->getLocationNames($latest_ads);
    }

    public function bestsellerAds($catId = null, $limit = 10)
    {
        return $this->model->currentAds()->orderBy('total_sales', 'desc')
            ->where(function ($query) use ($catId) {
                if ($catId) {
                    $query->where('cat1', $catId);
                }
            })
            ->limit($limit)->get();
    }

    public function getByCat($catID, $level = 1, $limit = 20)
    {
        $advs = $this->model
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', 'approved')
            ->where('slug', '!=', '')
            ->where('cat' . $level, $catID);

        if ($limit) {
            $advs = $advs->limit($limit);
        }

        $advs = $advs->get();

        $ads = $this->model->getLocationNames($advs);

        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $this->model->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index]->currency_price = app(Currency::class)->format($ad->price, $ad->currency);
            $ads[$index] = $this->model->AddAdsDefaultCoverImage($ad);
        }

        return $ads;
    }

    public function getAdsCountByCategory($catID, $level = 1)
    {
        return DB::table('advs_advs')
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', 'approved')
            ->whereNull('deleted_at')
            ->where('slug', '!=', '')
            ->where('cat' . $level, $catID)
            ->count();
    }

    public function getCategoriesWithAdID($id)
    {
        $adv = $this->model->find($id);

        if (!is_null($adv)) {
            $categories = array();
            foreach ($adv->toArray() as $key => $field) {
                if (preg_match('/cat\d/', $key) and !is_null($field)) {
                    $categories[$key] = $field;
                }
            }
            return $categories;
        }
        return null;
    }

    public function extendAds($allAds, $isAdmin = false)
    {
        if (is_array($allAds)) {
            $advs = $this->newQuery()->whereIn('id', $allAds);
        } elseif (!is_numeric($allAds)) {
            if ($isAdmin && auth()->user()->hasRole('admin')) {
                $advs = $this->newQuery();
            } else {
                $advs = $this->newQuery()->where('created_by_id', auth()->id());
            }
        } else {
            $advs = $this->newQuery()->where('id', $allAds);
        }
        $newDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . setting_value('visiosoft.module.advs::default_published_time') . ' day'));
        return $advs
            ->where('slug', '!=', '')
            ->update(['finish_at' => $newDate]);
    }

    public function getByUsersIDs($usersIDs, $status = 'approved', $withDraft = false)
    {
        $ads = $this
            ->newQuery()
            ->whereIn('advs_advs.created_by_id', $usersIDs);

        if ($status) {
            $ads = $ads->where('advs_advs.status', 'approved');
        }

        if (!$withDraft) {
            $ads = $ads
                ->where('advs_advs.slug', '!=', "")
                ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));
        }

        return $ads;
    }

    public function getPopular()
    {
        return $this->newQuery()
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->orderBy('count_show_ad', 'desc')
            ->paginate(setting_value('visiosoft.module.advs::popular_ads_limit', setting_value('streams::per_page')));
    }

    public function getName($id)
    {
        return $this->find($id)->name;
    }

    public function approveAds($adsIDs)
    {
        $defaultAdPublishTime = setting_value('visiosoft.module.advs::default_published_time');
        $ads = $this->newQuery()->whereIn('advs_advs.id', $adsIDs)->update([
            'status' => 'approved',
            'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
            'publish_at' => date('Y-m-d H:i:s')
        ]);

        return $ads;
    }

    public function getUserAds($userID = null, $status = "approved")
    {
        $userID = auth_id_if_null($userID);

        $query = $this->newQuery()
            ->where('advs_advs.created_by_id', $userID);

        if ($status) {
            $query = $query->where('status', $status);
        }
        return $query->where('finish_at', '>', date('Y-m-d H:i:s'))
            ->get();
    }

    public function currentAds()
    {
        return $this->newQuery()->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->orderBy('publish_at', 'desc');
    }

    public function expiredAds()
    {
        return $this->newQuery()
            ->whereDate('finish_at', '<', date("Y-m-d H:i:s"))
            ->where('slug', '!=', '')
            ->orderBy('publish_at', 'desc');
    }

    public function findByCFJSON($key, $value)
    {
        return $this->currentAds()
            ->whereJsonContains('cf_json', [$key => $value])
            ->first();
    }

    public function uploadImage()
    {
        $folder_repository = app(FolderRepositoryInterface::class);

        if (request()->has(['adv_id', 'upload'])
            and $adv = $this->newQuery()->find(request('adv_id'))
            and $folder = $folder_repository->findBySlug('images')) {


            $upload_service = app(UploadController::class);

            request()->offsetSet('folder', $folder->id);

            if ($response = $upload_service->upload()) {

                $file_id = $response->getData()->id;

                DB::table('advs_advs_files')->insert([
                    'entry_id' => $adv->id,
                    'file_id' => $file_id
                ]);

                return true;
            }
        }

        return false;
    }

    public function getStockReport()
    {
        $classifieds = $this->newQuery()
            ->current()
            ->select('stock', 'name', 'advs_advs.id', 'slug')
            ->where('is_get_adv', true)
            ->leftJoin('advs_advs_translations as classified_trans', function ($join) {
                $join->on('advs_advs.id', '=', 'classified_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $classifieds = $classifieds->where('name', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $classifieds = $classifieds->orderBy(request('order.0.column') == 1 ? 'stock' : 'name', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $classifieds->paginate($limit, ['*'], 'page', $page);
    }

    public function getAllClassifiedsCount()
    {
        return $this->newQuery()
            ->count();
    }

    public function getCurrentClassifiedsCount()
    {
        return $this->newQuery()
            ->current()
            ->count();
    }

    public function getUnexplainedClassifiedsReport()
    {
        $classifieds = $this->newQuery()
            ->current()
            ->select('classified_trans.name', 'advs_advs.id', 'slug')
            ->where(function ($query) {
                $query->where('classified_trans.advs_desc', '=', '')
                    ->orWhereNull('classified_trans.advs_desc');
            })
            ->leftJoin('advs_advs_translations as classified_trans', function ($join) {
                $join->on('advs_advs.id', '=', 'classified_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $classifieds = $classifieds->where('classified_trans.name', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $classifieds = $classifieds->orderBy('name', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $classifieds->paginate($limit, ['*'], 'page', $page);
    }

    public function getNoImageClassifiedsReport()
    {
        $classifieds = $this->newQuery()
            ->current()
            ->select('classified_trans.name', 'advs_advs.id', 'slug')
            ->where(function ($query) {
                $query->where('cover_photo', '=', '')
                    ->orWhereNull('cover_photo');
            })
            ->leftJoin('advs_advs_translations as classified_trans', function ($join) {
                $join->on('advs_advs.id', '=', 'classified_trans.entry_id');
                $join->whereIn('locale', [config('app.locale'), setting_value('streams::default_locale'), 'en']);
            });

        if ($search = request('search.value')) {
            $classifieds = $classifieds->where('classified_trans.name', 'LIKE', "%$search%");
        }

        if ($orderDir = request('order.0.dir')) {
            $classifieds = $classifieds->orderBy('name', $orderDir);
        }

        $start = request('start');
        $limit = request('length') ?: 10;
        $page = $start ? $start / $limit + 1 : 1;

        return $classifieds->paginate($limit, ['*'], 'page', $page);
    }

    public function getClassifiedsByCoordinates($lat, $lng, $distance = 50)
    {
        return $this
            ->currentAds()
            ->whereNotNull('map_Val')
            ->select(
                DB::raw("*, ( 3959 * acos( cos( radians('$lat') ) * cos( radians( SUBSTRING_INDEX(map_Val, ',', 1) ) ) * cos( radians( SUBSTRING_INDEX(map_Val, ',', -1) ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( SUBSTRING_INDEX(map_Val, ',', 1) ) ) ) ) AS distance")
            )
            ->havingRaw("distance < $distance")
            ->orderBy('distance')
            ->get();
    }

    public function getClassifiedsByCatsIDsAndLevels($categories, $limit = 10)
    {
        if (is_array($categories) && count($categories)) {
            return $this->getModel()
                ->currentAds()
                ->where(function ($query) use ($categories) {
                    foreach ($categories as $level => $categoryID) {
                        $query->orWhereIn("cat$level", $categoryID);
                    }
                })
                ->limit($limit)
                ->get();
        }

        return [];
    }
}
