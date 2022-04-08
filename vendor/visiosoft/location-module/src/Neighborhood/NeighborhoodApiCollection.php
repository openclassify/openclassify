<?php namespace Visiosoft\LocationModule\Neighborhood;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\ConnectModule\Command\CreateTranslatableValues;
use Visiosoft\LocationModule\District\DistrictRepository;

class NeighborhoodApiCollection extends NeighborhoodRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['name', 'slug', 'parent_district_id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (isset($params['id'])) {
            unset($params['id']);
        }

        // Check District
        $district = app(DistrictRepository::class);

        if (!$district = $district->find($params['parent_district_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'District']), 404);
        }

        $params = $this->dispatch(new CreateTranslatableValues($params));

        return $this->newQuery()->create(array_merge([
            'created_by_id' => Auth::id(),
            'created_at' => Carbon::now(),
        ], $params));
    }

    public function remove(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $neighborhood = $this->newQuery()->find($params['id']);

        if (!$neighborhood) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $neighborhood->update([
            'deleted_at' => Carbon::now(),
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        return collect(['message' => trans('streams::message.delete_success', ['count' => 1])]);
    }

    public function edit(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['id'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (!empty($params['parent_district_id']))
        {
            // Check District
            $district = app(DistrictRepository::class);

            if (!$district = $district->find($params['parent_district_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'District']), 404);
            }
        }

        $params = $this->dispatch(new CreateTranslatableValues($params));

        $neighborhood = $this->newQuery()->find($params['id']);

        if (!$neighborhood) {
            throw new \Exception(trans('streams::message.no_results'), 404);
        }

        $neighborhood->update(array_merge([
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
            $neighborhood = $this->newQuery()->find($params['id']);

            if (!$neighborhood) {
                throw new \Exception(trans('streams::message.no_results'), 404);
            }

            return $neighborhood;
        }

        return $this->newQuery();
    }
}
