<?php namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Search\SearchCriteria;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Presenter;
use Anomaly\Streams\Platform\Traits\Hookable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class EloquentCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EloquentCriteria
{

    use Hookable;
    use DispatchesJobs;

    /**
     * Additional available methods.
     *
     * @var array
     */
    protected $available = [
        'whereBetween',
        'whereNotBetween',
        'whereIn',
        'whereNotIn',
        'whereNull',
        'whereNotNull',
        'whereDate',
        'whereMonth',
        'whereDay',
        'whereYear',
        'whereColumn',
        'key',
    ];

    /**
     * Safe builder methods.
     *
     * @var array
     */
    private $disabled = [
        'delete',
        'update',
    ];

    /**
     * The query builder.
     *
     * @var EloquentQueryBuilder
     */
    protected $query;

    /**
     * Set the get method.
     *
     * @var string
     */
    protected $method;

    /**
     * Create a new EntryCriteria instance.
     *
     * @param Builder $query
     * @param string $method
     */
    public function __construct(Builder $query, $method = 'get')
    {
        $this->query  = $query;
        $this->method = $method;
    }

    /**
     * Store a cache collection key.
     *
     * @param null $key
     * @return null|string
     */
    public function key($key = null)
    {
        $key = $key ?: $this->query->getCacheKey();

        $this
            ->getQueryModel()
            ->getCacheCollection()
            ->key($key);

        return $key;
    }

    /**
     * Get the paginated entries.
     *
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @return array|\ArrayAccess|\IteratorAggregate|Presenter
     */
    public function paginate($perPage = 15, array $columns = ['*'], $pageName = 'page')
    {
        return (new Decorator())->decorate($this->query->paginate($perPage, $columns, $pageName));
    }

    /**
     * Return a new search criteria.
     *
     * @param  string $term
     * @return SearchCriteria
     */
    public function search($term)
    {
        return new SearchCriteria(
            $this->query->getModel()->search($term),
            $this->query->getModel()
        );
    }

    /**
     * Get the entries.
     *
     * @param  array $columns
     * @return Collection|Presenter|EntryPresenter
     */
    public function get(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->{$this->method}($columns));
    }

    /**
     * Get the entry count.
     *
     * @param  array $columns
     * @return int
     */
    public function count(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->count($columns));
    }

    /**
     * Get the aggregate sum.
     *
     * @param  $column
     * @return int
     */
    public function sum($column)
    {
        return (new Decorator())->decorate($this->query->sum($column));
    }

    /**
     * Get the aggregate max.
     *
     * @param  $column
     * @return int
     */
    public function max($column)
    {
        return (new Decorator())->decorate($this->query->max($column));
    }

    /**
     * Get the aggregate min.
     *
     * @param  $column
     * @return int
     */
    public function min($column)
    {
        return (new Decorator())->decorate($this->query->min($column));
    }

    /**
     * Get the aggregate avg.
     *
     * @param  $column
     * @return int
     */
    public function avg($column)
    {
        return (new Decorator())->decorate($this->query->avg($column));
    }

    /**
     * Find an entry.
     *
     * @param                           $identifier
     * @param  array $columns
     * @return Presenter|EntryPresenter
     */
    public function find($identifier, array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->find($identifier, $columns));
    }

    /**
     * Find an entry by column value.
     *
     * @param                           $column
     * @param                           $value
     * @param  array $columns
     * @return Presenter|EntryPresenter
     */
    public function findBy($column, $value, array $columns = ['*'])
    {
        $this->query->where($column, $value);

        return (new Decorator())->decorate($this->query->first($columns));
    }

    /**
     * Return the first entry.
     *
     * @param  array $columns
     * @return EloquentModel|EntryInterface
     */
    public function first(array $columns = ['*'])
    {
        return (new Decorator())->decorate($this->query->first($columns));
    }

    /**
     * Return the query string as SQL.
     *
     * @return string
     */
    public function toSql()
    {
        return $this->query->toSql();
    }

    /**
     * Return whether the method is safe or not.
     *
     * @param $name
     * @return bool
     */
    protected function methodIsSafe($name)
    {
        return (!in_array($name, $this->disabled));
    }

    /**
     * Return whether the method
     * exists on the query or not.
     *
     * @param $name
     * @return bool
     */
    protected function methodExists($name)
    {
        return method_exists($this->query->getQuery(), $name) || method_exists($this->query, $name);
    }

    /**
     * Get the query model.
     *
     * @return EloquentModel
     */
    protected function getQueryModel()
    {
        return $this->query->getModel();
    }

    /**
     * Route through __call.
     *
     * @param $name
     * @return Builder|null
     */
    public function __get($name)
    {
        return $this->__call($name, []);
    }

    /**
     * Call the method on the query.
     *
     * @param $name
     * @param $arguments
     * @return Builder|null
     */
    public function __call($name, $arguments)
    {
        $hook = snake_case($name);

        if ($this->hasHook($hook)) {
            return $this->call($hook, $arguments);
        }

        if ($this->query->hasHook($hook)) {
            return $this->query->call($hook, $arguments);
        }

        if ($this->methodExists($name) && $this->methodIsSafe($name)) {

            call_user_func_array([$this->query, $name], $arguments);

            return $this;
        }

        if (starts_with($name, 'findBy') && $column = snake_case(substr($name, 6))) {

            call_user_func_array([$this->query, 'where'], array_merge([$column], $arguments));

            return $this->first();
        }

        if (starts_with($name, 'where') && $column = snake_case(substr($name, 5))) {

            call_user_func_array([$this->query, 'where'], array_merge([$column], $arguments));

            return $this;
        }

        return $this;
    }

    /**
     * Return the string.
     *
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}
