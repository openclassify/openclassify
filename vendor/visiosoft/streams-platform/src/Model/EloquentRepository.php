<?php

namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Traits\Hookable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentRepository
 *
 * @property EloquentModel|EntryModel $model
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EloquentRepository implements EloquentRepositoryInterface
{

    use FiresCallbacks;
    use Hookable;

    /**
     * Return all records.
     *
     * @return EloquentCollection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Return all records with trashed.
     *
     * @return EloquentCollection
     */
    public function allWithTrashed()
    {
        return $this->model->withTrashed()->get();
    }

    /**
     * Return all records without relations.
     *
     * @return EloquentCollection
     */
    public function allWithoutRelations()
    {
        return $this->model
            ->newQueryWithoutRelationships()
            ->get();
    }

    /**
     * Find a record by it's ID.
     *
     * @param $id
     * @return EloquentModel
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a record by it's ID including trash.
     *
     * @param $id
     * @return EloquentModel
     */
    public function findWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    /**
     * Return all records without relations.
     *
     * @param $id
     * @return EloquentModel
     */
    public function findWithoutRelations($id)
    {
        return $this->model
            ->newQueryWithoutRelationships()
            ->find($id);
    }

    /**
     * Find a record by it's column value.
     *
     * @param $column
     * @param $value
     * @return EloquentModel|null
     */
    public function findBy($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * Find all records by IDs.
     *
     * @param  array $ids
     * @return EloquentCollection
     */
    public function findAll(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Find all by column value.
     *
     * @param $column
     * @param $value
     * @return EloquentCollection
     */
    public function findAllBy($column, $value)
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * Find a trashed record by it's ID.
     *
     * @param $id
     * @return null|EloquentModel
     */
    public function findTrashed($id)
    {
        return $this->model
            ->withTrashed()
            ->orderBy('id', 'ASC')
            ->where('id', $id)
            ->first();
    }

    /**
     * Create a new record.
     *
     * @param  array $attributes
     * @return EloquentModel
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Return a new query builder.
     *
     * @return Builder
     */
    public function newQuery()
    {
        return $this->model->newQuery();
    }

    /**
     * Return a new instance.
     *
     * @param array $attributes
     * @return EloquentModel
     */
    public function newInstance(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Count all records.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Return a paginated collection.
     *
     * @param  array $parameters
     * @return LengthAwarePaginator
     */
    public function paginate(array $parameters = [])
    {
        $paginator = array_pull($parameters, 'paginator');
        $perPage   = array_pull($parameters, 'per_page', config('streams::system.per_page', 15));

        /* @var Builder $query */
        $query = $this->model->newQuery();

        /*
         * First apply any desired scope.
         */
        if ($scope = array_pull($parameters, 'scope')) {
            call_user_func([$query, camel_case($scope)], array_pull($parameters, 'scope_arguments', []));
        }

        /*
         * Lastly we need to loop through all of the
         * parameters and assume the rest are methods
         * to call on the query builder.
         */
        foreach ($parameters as $method => $arguments) {
            $method = camel_case($method);

            if (in_array($method, ['update', 'delete'])) {
                continue;
            }

            if (is_array($arguments)) {
                call_user_func_array([$query, $method], $arguments);
            } else {
                call_user_func_array([$query, $method], [$arguments]);
            }
        }

        if ($paginator === 'simple') {
            $pagination = $query->simplePaginate($perPage);
        } else {
            $pagination = $query->paginate($perPage);
        }

        return $pagination;
    }

    /**
     * Save a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function save(EloquentModel $entry)
    {
        return $entry->save();
    }

    /**
     * Perform an action without events.
     *
     * @param \Closure $closure
     * @return mixed
     */
    public function withoutEvents(\Closure $closure)
    {
        $dispatcher = $this->model->getEventDispatcher();

        $this->model->unsetEventDispatcher();

        $result = app()->call($closure);

        $this->model->setEventDispatcher($dispatcher);

        return $result;
    }

    /**
     * Update multiple records.
     *
     * @param  array $attributes
     * @return bool
     */
    public function update(array $attributes = [])
    {
        return $this->model->update($attributes);
    }

    /**
     * Delete a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function delete(EloquentModel $entry)
    {
        return $entry->delete();
    }

    /**
     * Force delete a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function forceDelete(EloquentModel $entry)
    {
        $entry->forceDelete();

        /*
         * If we were not able to force delete
         */

        return !$entry->exists;
    }

    /**
     * Restore a trashed record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function restore(EloquentModel $entry)
    {
        return $entry->restore();
    }

    /**
     * Truncate the entries.
     *
     * @return $this
     */
    public function truncate()
    {
        $this->truncateModel($this->model);

        if ($this->model->isTranslatable()) {
            $this->truncateModel($this->model->getTranslationModel());
        }

        return $this;
    }

    /**
     * Truncate a given model
     *
     * @param EloquentModel $model The model
     */
    protected function truncateModel(EloquentModel $model)
    {
        $model->flushCache();

        foreach ($model->all() as $entry) {
            $this->delete($entry);
        }

        $model->truncate(); // Clear trash
    }

    /**
     * Cache a value in the
     * model's cache collection.
     *
     * @param $key
     * @param $ttl
     * @param $value
     * @return mixed
     */
    public function cache($key, $ttl, $value = null)
    {
        return $this->model->cache($key, $ttl, $value);
    }

    /**
     * Cache a value in the
     * model's cache collection.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function cacheForever($key, $value)
    {
        return $this->model->cacheForever($key, $value);
    }

    /**
     * Flush the cache.
     *
     * @return $this
     */
    public function flushCache()
    {
        $this->model->flushCache();

        $this->fire('flushed_cache');

        return $this;
    }

    /**
     * Guard the model.
     *
     * @return $this
     */
    public function guard()
    {
        $this->model->reguard();

        return $this;
    }

    /**
     * Unguard the model.
     *
     * @return $this
     */
    public function unguard()
    {
        $this->model->unguard();

        return $this;
    }

    /**
     * Set the model.
     *
     * @param  EloquentModel $model
     * @return $this
     */
    public function setModel(EloquentModel $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model.
     *
     * @return EloquentModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Pipe non-existing calls through hooks.
     *
     * @param $method
     * @param $parameters
     * @return mixed|null
     */
    public function __call($method, $parameters)
    {
        if ($this->hasHook($hook = snake_case($method))) {
            return $this->call($hook, $parameters);
        }

        return null;
    }
}
