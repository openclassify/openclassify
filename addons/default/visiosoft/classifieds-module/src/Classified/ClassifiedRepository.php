<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsClassifiedsEntryModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Visiosoft\ClassifiedsModule\Support\Command\Currency;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\LocationModule\District\DistrictModel;

class ClassifiedRepository extends EntryRepository implements ClassifiedRepositoryInterface
{
	protected $model;
	private $fileRepository;
	private $folderRepository;

	public function __construct(
		ClassifiedModel $model,
		FileRepositoryInterface $fileRepository,
		FolderRepositoryInterface $folderRepository
	)
	{
		$this->model = $model;
		$this->fileRepository = $fileRepository;
		$this->folderRepository = $folderRepository;
	}

	public function searchClassifieds(
		$type, $param = null, $customParameters = [],
		$limit = null, $category = null, $city = null, $paginate = true
	)
	{
		$isActiveDopings = new ClassifiedModel();
		$isActiveDopings = $isActiveDopings->is_enabled('dopings');

		$query = $this->model;
		$query = $query->where('classifieds_classifieds.slug', '!=', "");
		$query = $query->where('classifieds_classifieds.status', 'approved');
		$query = $query->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'));


		$query = $query->leftJoin('classifieds_classifieds_translations', function ($join) {
			$join->on('classifieds_classifieds.id', '=', 'classifieds_classifieds_translations.entry_id');
			$join->where('classifieds_classifieds_translations.locale', '=', Request()->session()->get('_locale', setting_value('streams::default_locale')));
		});

		if (!empty($param['keyword'])) {
			if (is_numeric($param['keyword'])) {
				$query = $query->where('classifieds_classifieds.id', $param['keyword']);
			} else {
				$delimiter = '_';
				$keyword = str_slug($param['keyword'], $delimiter);
				$query = $query->where(function ($query) use ($keyword) {
					$query->where('slug', 'like', '%' . $keyword . '%')
						->orWhere('classifieds_classifieds_translations.name', 'like', '%' . $keyword . '%');
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
			$query = $query->where('classifieds_classifieds.created_by_id', $param['user']);
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
				$query = $query->where('classifieds_classifieds.publish_at', '>=', Carbon::now()->subDay());
			} elseif ($param['date'] === 'two_days') {
				$query = $query->where('classifieds_classifieds.publish_at', '>=', Carbon::now()->subDays(2));
			} elseif ($param['date'] === 'week') {
				$query = $query->where('classifieds_classifieds.publish_at', '>=', Carbon::now()->subWeek());
			} elseif ($param['date'] === 'month') {
				$query = $query->where('classifieds_classifieds.publish_at', '>=', Carbon::now()->subMonth());
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
		if (!empty($param['get_classifieds']) && $param['get_classifieds'] == true) {
			$query = $query->where('is_get_classified', 1);
		}

		if (!empty($param['created_at'])) {
			$query = $query->whereDate('classifieds_classifieds.created_at', $param['created_at']);
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

//        //UPDATE `default_classifieds_classifieds` SET `coor` = (PointFromText('POINT(41.085022 28.804754)')) WHERE `default_classifieds_classifieds`.`id` = 8
//        //SELECT * FROM `default_classifieds_classifieds` WHERE ST_DISTANCE(ST_GeomFromText('POINT(41.0709052 28.829627)'), coor) < 20

		if (!empty($param['dlong']) && !empty($param['dlat']) && !empty($param['distance'])) {
			$query = $query->whereNotNull('coor');
			$query = $query->whereRaw("ST_DISTANCE(ST_GeomFromText('POINT(" . $param['dlong'] . " " . $param['dlat'] . ")'), coor) < " . $param['distance']);
		}

		if ($isActiveDopings) {
			$query = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')->search($query, $param);
		}

		if (!empty($param['sort_by'])) {
			switch ($param['sort_by']) {
				case "popular":
					$query = $query->orderBy('classifieds_classifieds.count_show_ad', 'desc');
					break;
				case "sort_price_up":
					$query = $query->orderBy('classifieds_classifieds.price', 'desc');
					break;
				case "sort_price_down":
					$query = $query->orderBy('classifieds_classifieds.price', 'asc');
					break;
				case "sort_time_newest":
					$query = $query->orderBy('classifieds_classifieds.created_at', 'desc');
					break;
				case "sort_time_oldest":
					$query = $query->orderBy('classifieds_classifieds.created_at', 'asc');
					break;
				case "address_a_z":
					$query = $query->join('location_cities_translations', 'classifieds_classifieds.city', '=', 'location_cities_translations.entry_id')
						->orderBy('location_cities_translations.name', 'ASC');
					break;
				case "address_z_a":
					$query = $query->join('location_cities_translations', 'classifieds_classifieds.city', '=', 'location_cities_translations.entry_id')
						->orderBy('location_cities_translations.name', 'DESC');
					break;
                case "name_z_a":
                    $query = $query->orderBy('classifieds_classifieds_translations.name', 'DESC');
                    break;
                case "name_a_z":
                    $query = $query->orderBy('classifieds_classifieds_translations.name', 'ASC');
                    break;
			}
		} else {
			$query = $query->orderBy('classifieds_classifieds.created_at', 'desc');
		}

		if ($isActiveDopings) {
			$query = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')->querySelect($query, $param);
		} else {
			$query = $query->select('classifieds_classifieds.*', 'classifieds_classifieds_translations.name as name',
				'classifieds_classifieds_translations.classifieds_desc as classifieds_desc');
		}

		if ($type == "list") {
			return $paginate ? $query->paginate(setting_value('streams::per_page')) : $query;
		} else {
			return $query->get();
		}
	}

	public function softDeleteClassified($id)
	{
		return $this->find($id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
	}

	public function getLocationNames($classified)
	{
		$country = CountryModel::query()->where('location_countries.id', $classified->country_id)->first();
		$city = CityModel::query()->where('location_cities.id', $classified->city)->first();
		$district = DistrictModel::query()->where('location_districts.id', $classified->district)->first();
		if ($country != null) {
			$classified->setAttribute('country_name', $country->name);
		}
		if ($city != null) {
			$classified->setAttribute('city_name', $city->name);
		}
		if ($district != null) {
			$classified->setAttribute('district_name', $district->name);
		}
		return $classified;
	}

	public function getCatNames($classified)
	{
		$cat1 = CategoryModel::query()->where('cats_category.id', $classified->cat1)->first();
		$cat2 = CategoryModel::query()->where('cats_category.id', $classified->cat2)->first();

		if (!is_null($cat1))
			$classified->setAttribute('cat1_name', $cat1->name);
		else
			$classified->setAttribute('cat1_name', "");

		if (!is_null($cat2))
			$classified->setAttribute('cat2_name', $cat2->name);

		else
			$classified->setAttribute('cat2_name', "");


		return $classified;
	}

	public function findByIDAndSlug($id, $slug)
	{
		$classified = $this->newQuery()
			->where('classifieds_classifieds.id', $id)
			->where('slug', $slug)
			->first();

		if ($classified) {
			$classified = $this->getLocationNames($classified);
		}

		return $classified;
	}

	public function getListItemClassified($id)
	{
		$classified = $this->model
			->where('classifieds_classifieds.id', $id)
			->leftJoin('users_users as u1', 'classifieds_classifieds.created_by_id', '=', 'u1.id')
			->select('classifieds_classifieds.*', 'u1.first_name as first_name', 'u1.last_name as last_name', 'u1.id as owner_id')
			->inRandomOrder()
			->first();

		if ($classified) {
			$classified = $this->getLocationNames($classified);
		}

		return $classified;
	}

	public function addAttributes($classifieds)
	{
		foreach ($classifieds as $classified) {
			$classified = $this->getLocationNames($classified);
			$classified = $this->getCatNames($classified);
		}

		return $classifieds;
	}

	public function cover_image_update($classified)
	{
		if (count($classified->files) != 0) {
            $fileName = $classified->files[0]->name;
            $ext = explode('.',$fileName);
            if ($ext[1] != 'svg') {
                $fileName = 'tn-' . $fileName;
            }

			$folder = $this->folderRepository->findBySlug('images');
			$thumbnail = $this->fileRepository->findByNameAndFolder($fileName, $folder);

            if (!$thumbnail AND $ext[1] != 'svg') {

				// Create thumbnail image
				$image = Image::make(file_get_contents($classified->files[0]->make()->url()));
				$image->resize(
					null,
					setting_value('visiosoft.module.classifieds::thumbnail_height'),
					function ($constraint) {
						$constraint->aspectRatio();
					});
				if (setting_value('visiosoft.module.classifieds::add_canvas')) {
					$image->resizeCanvas(
						setting_value('visiosoft.module.classifieds::thumbnail_width'),
						setting_value('visiosoft.module.classifieds::thumbnail_height'),
						'center', false, 'fff'
					);
				}
				$fileName = 'tn-' . $classified->files[0]->name;
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
		$classified->update(['cover_photo' => $coverPhoto]);
	}

	public function getRecommendedClassifieds($id)
	{
		return ClassifiedModel::query()
			->where('classifieds_classifieds.id', '!=', $id)
			->where('classifieds_classifieds.status', 'approved')
			->select('classifieds_classifieds.*')
			->orderBy('id', 'desc')
			->take(4)
			->get();
	}

	public function getLastAd($id)
	{
		return ClassifiedsClassifiedsEntryModel::query()->where('classifieds_classifieds.created_by_id', '=', $id)->max('id');
	}

	public function getClassifiedArray($id)
	{
		$classified = ClassifiedsClassifiedsEntryModel::query()->where('classifieds_classifieds.id', $id)->first();

		return ($classified !== null) ? $classified->toArray() : null;
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
		return $this->model->orderBy('created_at', 'DESC')->whereIn('classifieds_classifieds.id', $ids)->get();
	}


	/**
	 * Get Latest Classifieds
	 * @return mixed
	 */
	public function latestClassifieds()
	{
		$latest_classifieds = $this->model->currentClassifieds()
			->limit(setting_value('visiosoft.module.classifieds::latest-limit'))
			->get();

        if (setting_value('visiosoft.module.classifieds::hide_out_of_stock_products_without_listing')) {
            $latest_classifieds = $latest_classifieds->filter(
                function ($entry) {
                    return (($entry->is_get_classified == true && $entry->stock > 0) || ($entry->is_get_classified == false));
                }
            );
        }

		return $this->model->getLocationNames($latest_classifieds);
	}

	public function bestsellerClassifieds($catId = null, $limit = 10)
	{
		return $this->model->currentClassifieds()->orderBy('total_sales', 'desc')
			->where(function ($query) use ($catId) {
				if ($catId) {
					$query->where('cat1', $catId);
				}
			})
			->limit($limit)->get();
	}

	public function getByCat($catID, $level = 1, $limit = 20)
	{
		$classifieds = $this->model
			->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
			->where('status', 'approved')
			->where('slug', '!=', '')
			->where('cat' . $level, $catID);

		if ($limit) {
			$classifieds = $classifieds->limit($limit);
		}

		$classifieds = $classifieds->get();

		$classifieds = $this->model->getLocationNames($classifieds);

		foreach ($classifieds as $index => $classified) {
			$classifieds[$index]->detail_url = $this->model->getClassifiedDetailLinkByModel($classified, 'list');
			$classifieds[$index]->currency_price = app(Currency::class)->format($classified->price, $classified->currency);
			$classifieds[$index] = $this->model->AddClassifiedsDefaultCoverImage($classified);
		}

		return $classifieds;
	}

	public function getClassifiedsCountByCategory($catID, $level = 1)
	{
		return DB::table('classifieds_classifieds')
			->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
			->where('status', 'approved')
			->whereNull('deleted_at')
			->where('slug', '!=', '')
			->where('cat' . $level, $catID)
			->count();
	}

	public function getCategoriesWithAdID($id)
	{
		$classified = $this->model->find($id);

		if (!is_null($classified)) {
			$categories = array();
			foreach ($classified->toArray() as $key => $field) {
				if (preg_match('/cat\d/', $key) and !is_null($field)) {
					$categories[$key] = $field;
				}
			}
			return $categories;
		}
		return null;
	}

	public function extendClassifieds($allClassifieds, $isAdmin = false)
	{
		if (is_array($allClassifieds)) {
			$classifieds = $this->newQuery()->whereIn('id', $allClassifieds);
		} elseif (!is_numeric($allClassifieds)) {
			if ($isAdmin && auth()->user()->hasRole('admin')) {
				$classifieds = $this->newQuery();
			} else {
				$classifieds = $this->newQuery()->where('created_by_id', auth()->id());
			}
		} else {
			$classifieds = $this->newQuery()->where('id', $allClassifieds);
		}
		$newDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . setting_value('visiosoft.module.classifieds::default_published_time') . ' day'));
		return $classifieds
			->where('slug', '!=', '')
			->update(['finish_at' => $newDate]);
	}

	public function getByUsersIDs($usersIDs, $status = 'approved', $withDraft = false)
	{
		$classifieds = $this
			->newQuery()
			->whereIn('classifieds_classifieds.created_by_id', $usersIDs);

		if ($status) {
			$classifieds = $classifieds->where('classifieds_classifieds.status', 'approved');
		}

		if (!$withDraft) {
			$classifieds = $classifieds
				->where('classifieds_classifieds.slug', '!=', "")
				->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'));
		}

		return $classifieds;
	}

	public function getPopular()
	{
		return $this->newQuery()
			->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
			->where('status', '=', 'approved')
			->where('slug', '!=', '')
			->orderBy('count_show_ad', 'desc')
			->paginate(setting_value('visiosoft.module.classifieds::popular_classifieds_limit', setting_value('streams::per_page')));
	}

	public function getName($id)
	{
		return $this->find($id)->name;
	}

	public function approveClassifieds($classifiedsIDs)
	{
		$defaultAdPublishTime = setting_value('visiosoft.module.classifieds::default_published_time');
		$classifieds = $this->newQuery()->whereIn('classifieds_classifieds.id', $classifiedsIDs)->update([
			'status' => 'approved',
			'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
			'publish_at' => date('Y-m-d H:i:s')
		]);

		return $classifieds;
	}

	public function getUserClassifieds($userID = null, $status = "approved")
	{
		$userID = auth_id_if_null($userID);

		$query = $this->newQuery()
			->where('classifieds_classifieds.created_by_id', $userID);

		if ($status) {
			$query = $query->where('status', $status);
		}
		return $query->where('finish_at', '>', date('Y-m-d H:i:s'))
			->get();
	}

    public function currentClassifieds() {
        return $this->newQuery()->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '')
            ->orderBy('publish_at', 'desc');
    }
}
