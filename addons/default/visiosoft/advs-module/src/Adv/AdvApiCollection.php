<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\ConnectModule\Command\CreateTranslatableValues;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\Country\CountryRepository;
use Visiosoft\LocationModule\District\DistrictRepository;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodRepository;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\MediaFieldType\Http\Controller\UploadController;

class AdvApiCollection extends AdvRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        if (isset($params['id'])) {
            unset($params['id']);
        }

        $this->checkSubCategories($params);

        $this->checkLocation($params);

        $this->checkGet($params);

        $this->dispatchSync(new CheckRequiredParams(['name', 'price', 'standard_price', 'currency', 'advs_desc'], $params));

        $defaultAdPublishTime = setting_value('visiosoft.module.advs::default_published_time', 30);

        $slug = is_array($params['name']) ? array_first($params['name']) : $params['name'];

        $create_parameters = array_merge($params, [
            'finish_at' => Carbon::now()->addDays(intval($defaultAdPublishTime)),
            'publish_at' => Carbon::now(),
            'created_by_id' => Auth::id(),
            'old_price' => $params['price'],
            'slug' => Str::slug($slug . strtotime("now"), '_'),
            'created_at' => Carbon::now(),
            'status' => setting_value('visiosoft.module.advs::auto_approve', true) ? 'approved' : 'pending_user',
        ]);

        $create_parameters = $this->dispatchSync(new CreateTranslatableValues($create_parameters));

        return $this->create($create_parameters);
    }

    public function checkGet($params)
    {
        if (!empty($params['is_get_adv'])) {
            $this->dispatchSync(new CheckRequiredParams(['stock'], $params));
        }
    }

    public function checkLocation($params)
    {
        $city_repository = app(CityRepository::class);
        $district_repository = app(DistrictRepository::class);
        $country_repository = app(CountryRepository::class);
        $neighborhood_repository = app(NeighborhoodRepository::class);
        $village_repository = app(VillageRepository::class);

        if (!empty($params['country_id']) && !$country = $country_repository->find($params['country_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Country']), 404);
        }

        if (!empty($params['city']) && !$city = $city_repository->find($params['city'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'City']), 404);
        }

        if (!empty($params['district']) && !$district = $district_repository->find($params['district'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'District']), 404);
        }

        if (!empty($params['neighborhood']) && !$neighborhood = $neighborhood_repository->find($params['neighborhood'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Neighborhood']), 404);
        }

        if (!empty($params['village']) && !$village = $village_repository->find($params['village'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Village']), 404);
        }

        if (!empty($params['city']) && $city->parent_country_id != $params['country_id']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $country->name, 'to' => $city->name]), 404);
        }

        if (!empty($params['district']) && $district->parent_city_id != $params['city']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $city->name, 'to' => $district->name]), 404);
        }

        if (!empty($params['neighborhood']) && $neighborhood->parent_district_id != $params['district']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $district->name, 'to' => $neighborhood->name]), 404);
        }

        if (!empty($params['village']) && $village->parent_neighborhood_id != $params['neighborhood']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $neighborhood->name, 'to' => $village->name]), 404);
        }
    }

    public function checkSubCategories($params, $level = 1)
    {
        $this->dispatchSync(new CheckRequiredParams(['cat' . $level], $params));

        $category_repository = app(CategoryRepository::class);

        if (!$category = $category_repository->find($params['cat' . $level])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Category']), 404);
        }

        if ($level != 1 && $category->parent_category_id != $params['cat' . (intval($level) - 1)]) {
            throw new \Exception(trans('visiosoft.module.advs::message.error_select_related_category'), 404);
        }

        $is_sub = $category_repository->getSubCatById($params['cat' . $level]);

        if (count($is_sub)) {
            $level++;
            return $this->checkSubCategories($params, $level);
        }
    }

    public function remove(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!$advs = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
        }

        if ($advs->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $advs->update([
            'deleted_at' => Carbon::now(),
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        return collect(['message' => trans('streams::message.delete_success', ['count' => 1])]);
    }

    public function edit(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!$advs = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
        }

        if ($advs->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        for ($cat_index = 1; $cat_index <= 10; $cat_index++) {
            if (isset($params['cat' . $cat_index])) {
                $this->checkSubCategories($params);

                break;
            }
        }

        $this->checkLocation($params);

        $this->checkGet($params);

        if (isset($params['slug'])) {
            unset($params['slug']);
        }

        if (isset($params['created_by_id'])) {
            unset($params['created_by_id']);
        }

        $params = $this->dispatchSync(new CreateTranslatableValues($params));

        $advs->update(array_merge([
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ], $params));

        return collect(['message' => trans('streams::message.edit_success', ['name' => $params['id']])]);
    }

    public function list(array $params)
    {
        if (!empty($params['id'])) {
            $advs = $this->newQuery()->find($params['id']);

            if (!$advs) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
            }

            return $advs;
        }

        return $this->newQuery();
    }

    public function addImage(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!$advs = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
        }

        if ($advs->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (!request()->hasFile('upload')) {
            throw new \Exception(trans('visiosoft.module.connect::message.required_parameter', ['parameter' => 'upload']));
            die;
        }

        $upload_service = app(UploadController::class);
        $folders = app(FolderRepositoryInterface::class);

        $folder = $folders->findBySlug('images');

        request()->offsetSet('folder', $folder->id);
        request()->offsetSet('adv_id', $advs->id);

        if ($response = $upload_service->upload()) {

            $file_id = $response->getData()->id;

            DB::table('advs_advs_files')->insert([
                'entry_id' => $advs->id,
                'file_id' => $file_id
            ]);

            $this->cover_image_update($advs);

            return collect(['message' => trans('streams::message.edit_success', ['name' => $params['id']])]);
        }
    }

    public function listImages(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!$advs = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
        }

        $files = $advs->files()->get();
        foreach ($files as $file) {
            $file->url = $file->make()->url();
        }

        return $files;
    }

    public function removeImage(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id', 'image_id'], $params));

        if (!$advs = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Ad']), 404);
        }

        if ($advs->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $files = $advs->files()->get();

        $files = $files->filter(function ($entry) use ($params) {
            return $entry->id == $params['image_id'];
        });

        if (!count($files))
        {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Image']), 404);
        }

        DB::table('advs_advs_files')
            ->where('entry_id',$advs->id)
            ->where('file_id',$files[0]->id)
            ->delete();

        return collect(['message' => trans('streams::message.delete_success', ['count' => 1])]);
    }


}
