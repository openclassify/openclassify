<?php namespace Visiosoft\CatsModule\Category;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\ConnectModule\Command\CreateTranslatableValues;

class CategoryApiCollection extends CategoryRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['name', 'slug', 'seo_keyword', 'seo_description'], $params));

        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (isset($params['id'])) {
            unset($params['id']);
        }

        if (!empty($params['parent_category_id'])) {
            if (!$category = $this->find($params['parent_category_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Parent category']), 404);
            }
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

        $category = $this->newQuery()->find($params['id']);

        if (!$category) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Category']), 404);
        }

        $category->update([
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

        if (!empty($params['parent_category_id'])) {

            if (!$parent = $this->newQuery()->find($params['parent_category_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Parent category']), 404);
            }
        }

        $params = $this->dispatch(new CreateTranslatableValues($params));

        $category = $this->newQuery()->find($params['id']);

        if (!$category) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Category']), 404);
        }

        $category->update(array_merge([
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
            $category = $this->newQuery()->find($params['id']);

            if (!$category) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Category']), 404);
            }

            return $category;
        }

        return $this->newQuery();
    }

    public function editIcon(array $params)
    {
        if (!Auth::user()->hasRole('admin'))
        {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $this->dispatch(new CheckRequiredParams(['id'], $params));

        if (!isset(request()->file('options')['parameters']['icon'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.required_parameter', ['parameter' => 'icon']));
            die;
        }

        if (!$category = $this->newQuery()->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Category']), 404);
        }

        $file = request()->file('options')['parameters']['icon'];

        $this->setCategoryIcon($category->id, $file);

        return collect(['message' => trans('streams::message.edit_success', ['name' => 'Icon'])]);
    }
}
