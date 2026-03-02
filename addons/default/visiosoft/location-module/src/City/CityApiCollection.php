<?php namespace Visiosoft\LocationModule\City;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\ConnectModule\Command\CreateTranslatableValues;
use Visiosoft\LocationModule\Country\CountryRepository;

class CityApiCollection extends CityRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['name', 'slug', 'parent_country_id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (isset($params['id'])) {
            unset($params['id']);
        }

        // Check Country
        $country_repository = app(CountryRepository::class);

        if (!$country = $country_repository->find($params['parent_country_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Country']), 404);
        }

        $params = $this->dispatchSync(new CreateTranslatableValues($params));

        return $this->newQuery()->create(array_merge([
            'created_by_id' => Auth::id(),
            'created_at' => Carbon::now(),
        ], $params));
    }

    public function remove(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $city = $this->newQuery()->find($params['id']);

        if (!$city) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $city->update([
            'deleted_at' => Carbon::now(),
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        return collect(['message' => trans('streams::message.delete_success', ['count' => 1])]);
    }

    public function edit(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (!empty($params['parent_country_id']))
        {
            // Check Country
            $country_repository = app(CountryRepository::class);

            if (!$country = $country_repository->find($params['parent_country_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Country']), 404);
            }
        }

        $params = $this->dispatchSync(new CreateTranslatableValues($params));

        $city = $this->newQuery()->find($params['id']);

        if (!$city) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $city->update(array_merge([
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ], $params));

        return collect(['message' => trans('streams::message.edit_success', ['name' => $params['id']])]);
    }

    public function list(array $params)
    {
        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (!empty($params['id'])) {
            $city = $this->newQuery()->find($params['id']);

            if (!$city) {
                throw new \Exception(trans('streams::message.no_results'), 404);
            }

            return $city;
        }

        return $this->newQuery();
    }
}
