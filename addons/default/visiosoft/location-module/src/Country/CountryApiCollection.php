<?php namespace Visiosoft\LocationModule\Country;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\ConnectModule\Command\CreateTranslatableValues;

class CountryApiCollection extends CountryRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['name', 'slug', 'abv'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (isset($params['id'])) {
            unset($params['id']);
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

        $country = $this->newQuery()->find($params['id']);

        if (!$country) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $country->update([
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

        $params = $this->dispatchSync(new CreateTranslatableValues($params));

        $country = $this->newQuery()->find($params['id']);

        if (!$country) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $country->update(array_merge([
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
            $country = $this->newQuery()->find($params['id']);

            if (!$country) {
                throw new \Exception(trans('streams::message.no_results'), 404);
            }

            return $country;
        }

        return $this->newQuery();
    }
}
