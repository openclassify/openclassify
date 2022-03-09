<?php

namespace Anomaly\Streams\Platform\Model\Contract;

use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Interface EloquentRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface EloquentRepositoryInterface
{

    /**
     * Return all records.
     *
     * @return EloquentCollection
     */
    public function all();

    /**
     * Return all records with trashed.
     *
     * @return EloquentCollection
     */
    public function allWithTrashed();

    /**
     * Return all records without relations.
     *
     * @return EloquentCollection
     */
    public function allWithoutRelations();

    /**
     * Find a record by it's ID.
     *
     * @param $id
     * @return null|EloquentModel
     */
    public function find($id);

    /**
     * Find a record by it's ID including trash.
     *
     * @param $id
     * @return EloquentModel
     */
    public function findWithTrashed($id);

    /**
     * Return all records without relations.
     *
     * @param $id
     * @return EloquentModel
     */
    public function findWithoutRelations($id);

    /**
     * Find a record by it's column value.
     *
     * @param $column
     * @param $value
     * @return EloquentModel|null
     */
    public function findBy($column, $value);

    /**
     * Find all records by IDs.
     *
     * @param  array $ids
     * @return EloquentCollection
     */
    public function findAll(array $ids);

    /**
     * Find all by column value.
     *
     * @param $column
     * @param $value
     * @return EloquentCollection
     */
    public function findAllBy($column, $value);

    /**
     * Find a trashed record by it's ID.
     *
     * @param $id
     * @return null|EloquentModel
     */
    public function findTrashed($id);

    /**
     * Create a new record.
     *
     * @param  array $attributes
     * @return EloquentModel
     */
    public function create(array $attributes);

    /**
     * Return a new query builder.
     *
     * @return Builder
     */
    public function newQuery();

    /**
     * Return a new instance.
     *
     * @param array $attributes
     * @return EloquentModel
     */
    public function newInstance(array $attributes = []);

    /**
     * Count all records.
     *
     * @return int
     */
    public function count();

    /**
     * Return a paginated collection.
     *
     * @param  array $parameters
     * @return LengthAwarePaginator
     */
    public function paginate(array $parameters = []);

    /**
     * Perform an action without events.
     *
     * @param  EloquentModel $entry
     * @param \Closure $closure
     * @return mixed
     */
    public function withoutEvents(\Closure $closure);

    /**
     * Save a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function save(EloquentModel $entry);

    /**
     * Update multiple records.
     *
     * @param  array $attributes
     * @return bool
     */
    public function update(array $attributes = []);

    /**
     * Delete a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function delete(EloquentModel $entry);

    /**
     * Force delete a record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function forceDelete(EloquentModel $entry);

    /**
     * Restore a trashed record.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function restore(EloquentModel $entry);

    /**
     * Truncate the entries.
     *
     * @return $this
     */
    public function truncate();

    /**
     * Cache a value in the
     * model's cache collection.
     *
     * @param $key
     * @param $ttl
     * @param null $value
     * @return mixed
     */
    public function cache($key, $ttl, $value = null);

    /**
     * Cache (forever) a value in
     * the model's cache collection.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function cacheForever($key, $value);

    /**
     * Flush the cache.
     *
     * @return $this
     */
    public function flushCache();

    /**
     * Guard the model.
     *
     * @return $this
     */
    public function guard();

    /**
     * Unguard the model.
     *
     * @return $this
     */
    public function unguard();

    /**
     * Set the repository model.
     *
     * @param  EloquentModel $model
     * @return $this
     */
    public function setModel(EloquentModel $model);

    /**
     * Get the model.
     *
     * @return EloquentModel
     */
    public function getModel();
}
