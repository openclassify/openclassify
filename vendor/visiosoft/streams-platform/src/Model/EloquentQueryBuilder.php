<?php

namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Collection\CacheCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Stream\StreamModel;
use Anomaly\Streams\Platform\Traits\Hookable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * Class EloquentQueryBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EloquentQueryBuilder extends Builder
{

    use Hookable;
    use DispatchesJobs;

    /**
     * Runtime cache.
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * The model being queried.
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * The cache key.
     *
     * @var null|string
     */
    protected $cacheKey = null;

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get($columns = ['*'])
    {
        $key = $this->getCacheKey();

        $ttl        = $this->model->ttl();
        $collection = $this->model->getCacheCollectionKey();

        $enabled = config('streams::database.cache', false);

        /**
         * Check the runtime cache first.
         */
        if (isset(self::$cache[$collection][$key])) {
            return self::$cache[$collection][$key];
        }

        /**
         * Do not cache...
         * - If not installed
         * - For the control panel
         * - If DB cache is disabled.
         * - If the system is not "installed"
         * - If the console is making the request
         */
        if (
            env('INSTALLED') &&
            !IS_ADMIN &&
            $enabled &&
            PHP_SAPI != 'cli' &&
            $ttl
        ) {

            $this->rememberIndex();
            $this->orderByDefault();

            try {
                return self::$cache[$collection][$key] = app('cache')->remember(
                    $key,
                    $ttl,
                    function () use ($columns) {
                        return parent::get($columns);
                    }
                );
            } catch (\Exception $e) {
                return self::$cache[$collection][$key] = parent::get($columns);
            }
        }

        $this->orderByDefault();

        /**
         * Skip this all together if
         * we are not installed or
         * if we're running CLI.
         */
        if ($this->model->getTtl() === false || !env('INSTALLED') || PHP_SAPI == 'cli') {
            return parent::get($columns);
        }

        return self::$cache[$collection][$key] = parent::get($columns);
    }

    /**
     * Return if a table has been joined or not.
     *
     * @param $table
     * @return bool
     */
    public function hasJoin($table)
    {
        if (!$this->query->joins) {
            return false;
        }

        /* @var JoinClause $join */
        foreach ($this->query->joins as $join) {
            if ($join->table === $table) {
                return true;
            }
        }

        return false;
    }

    /**
     * Remember and index.
     *
     * @return $this
     */
    protected function rememberIndex()
    {
        if ($this->model->ttl()) {
            $this->indexCacheCollection();
        }

        return $this;
    }

    /**
     * Index cache collection
     *
     * @return object
     */
    protected function indexCacheCollection()
    {
        (new CacheCollection())
            ->make([$this->getCacheKey()])
            ->setKey($this->model->getCacheCollectionKey())
            ->index();

        return $this;
    }

    /**
     * Drop a cache collection
     * from runtime cache.
     *
     * @param $collection
     */
    public static function dropRuntimeCache($collection)
    {
        unset(self::$cache[$collection]);
    }

    /**
     * Get the unique cache key for the query.
     *
     * @return string
     */
    public function getCacheKey()
    {
        if ($this->cacheKey) {
            return $this->cacheKey;
        }

        $name = $this->model->getConnectionName();

        return $this->model->getCacheCollectionKey() . ':' . md5(
            $name . $this->toSql() . serialize($this->getBindings())
        );
    }

    /**
     * Set the cache key.
     *
     * @param $key
     * @return string
     */
    public function setCacheKey($key)
    {
        $this->cacheKey = $key;

        return $this;
    }

    /**
     * Set the model TTl.
     *
     * @param $ttl
     * @return $this
     */
    public function cache($ttl = null)
    {
        if (!config('streams::database.cache', false)) {

            $this->model->setTtl(0);

            return $this;
        }

        if ($ttl === null) {
            $ttl = config('streams::database.ttl', 3600);
        }

        $this->model->setTtl($ttl / 60);

        return $this;
    }

    /**
     * Get fresh models / disable cache
     *
     * @param  boolean $fresh
     * @return object
     */
    public function fresh($fresh = true)
    {
        if ($fresh) {
            $this->model->setTtl(0);
        }

        return $this;
    }

    /**
     * Update a record in the database.
     *
     * @param  array $values
     * @return int
     */
    public function update(array $values)
    {
        $this->model->fireEvent('updatingMultiple');

        $return = parent::update($values);

        $this->model->fireEvent('updatedMultiple');

        return $return;
    }

    /**
     * Delete a record from the database.
     *
     * @return mixed
     */
    public function delete()
    {
        $this->model->fireEvent('deletingMultiple');

        $return = parent::delete();

        $this->model->fireEvent('deletedMultiple');

        return $return;
    }

    /**
     * Order by sort_order if null.
     */
    protected function orderByDefault()
    {
        $model = $this->getModel();
        $query = $this->getQuery();

        /*
         * The INSTALLED variable in the .env file for the site module has been made dynamic.
         * Owner : Vedat Akdoğan
         */

        $app = (new ArgvInput())->getParameterOption('--app', env('APPLICATION_REFERENCE', 'default'));

        $is_installed = env('INSTALLED');

        if (env('APPLICATION_REFERENCE', 'default') != $app) {

            $app_config = \Dotenv\Dotenv::parse(file_get_contents(base_path('resources/' . $app . '/.env')));
            $is_installed = filter_var($app_config['INSTALLED'], FILTER_VALIDATE_BOOLEAN);
        }

        if ($query->orders === null) {
            if ($model instanceof AssignmentModel) {
                $query->orderBy('streams_assignments.sort_order', 'ASC');
            } elseif ($model instanceof StreamModel && $is_installed) { // Ensure migrations are complete.
                $query->orderBy('streams_streams.sort_order', 'ASC');
            } elseif ($model instanceof EntryInterface) {
                if ($model->getStream()->isSortable()) {
                    $query->orderBy($model->getTable() . '.sort_order', 'ASC');
                } elseif ($model->titleColumnIsTranslatable()) {

                    /**
                     * Postgres makes it damn near impossible
                     * to order by a foreign column and retain
                     * distinct results so let's avoid it entirely.
                     *
                     * Sorry!
                     *
                     * @var EntryModel|EloquentModel $model
                     */
                    $connection = $this->model->getConnectionName() ?: config('database.default');

                    if (preg_match('/sqlsrv|pgsql/', config('database.connections')[$connection]['driver'])) {
                        return;
                    }

                    $this
                        ->translate()
                        ->orderBy($model->getTranslationsTableName() . '.' . $model->getTitleName(), 'ASC');
                } elseif ($model->getTitleName() && $model->getTitleName() !== 'id') {
                    $query->orderBy($model->getTitleName(), 'ASC');
                }
            }
        }
    }

    /**
     * Join the translations table.
     *
     * @param null $locale
     */
    public function translate($locale = null)
    {
        /* @var EntryModel|EloquentModel $model */
        $model = $this->getModel();

        if (!$this->hasJoin($model->getTranslationsTableName())) {
            $this->query->leftJoin(
                $model->getTranslationsTableName(),
                $model->getTableName() . '.id',
                '=',
                $model->getTranslationsTableName() . '.entry_id'
            );
        }

        $this->query->addSelect(
            [$model->getTableName() . '.*'] +
                array_map(
                    function ($column) use ($model) {
                        return $model->getTranslationTableName() . '.' . $column;
                    },
                    array_diff(
                        $this->getConnection()->getSchemaBuilder()->getColumnListing($model->getTranslationTableName()),
                        [
                            'entry_id',
                            'created_at',
                            'created_by_id',
                            'updated_at',
                            'updated_by_id',
                            'sort_order',
                            'id',
                        ]
                    )
                )
        );

        /**
         * removed to prevent data repeatation( getTranslationsTableName() )
         */
        $this->query->groupBy([$model->getTableName() . '.id']);

        /**
         * Grab either what matches or null because
         * that should cover every parent record.
         */
        $this->query->where(
            function (\Illuminate\Database\Query\Builder $query) use ($model, $locale) {
                $query->where($model->getTranslationsTableName() . '.locale', $locale ?: config('app.locale'));//active language
                $query->orWhere($model->getTranslationsTableName() . '.locale',setting_value('streams::default_locale'));//or default setting language
                $query->orWhere($model->getTranslationsTableName() . '.locale','en');//or default module language
            }
        );

        return $this;
    }

    /**
     * Select the default columns.
     *
     * This is helpful when using addSelect
     * elsewhere like in a hook/criteria and
     * that select ends up being all you select.
     *
     * @return $this
     */
    public function selectDefault()
    {
        if (!$this->query->columns && $this->query->from) {
            $this->query->select($this->query->from . '.*');
        }

        return $this;
    }

    /**
     * Add hookable catch to the query builder system.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if ($this->hasHook($hook = snake_case($method))) {
            return $this->call($hook, $parameters);
        }

        return parent::__call($method, $parameters);
    }
}
