<?php namespace Anomaly\Streams\Platform\Search;

use Anomaly\Streams\Platform\Traits\Hookable;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Support\Presenter;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Pagination\Paginator;
use Laravel\Scout\Builder;

class SearchCriteria
{
    use Hookable;

    /**
     * The search builder.
     *
     * @var Builder
     */
    protected $query;

    /**
     * The model object.
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * Create a new SearchCriteria instance.
     *
     * @param Builder       $query
     * @param EloquentModel $model
     */
    public function __construct(Builder $query, EloquentModel $model)
    {
        $this->query  = $query;
        $this->model  = $model;
    }

    /**
     * Get the paginated entries.
     *
     * @return Collection
     */
    public function paginate($perPage = 15, $pageName = 'page', $page = null)
    {
        $paginator = $this->query->paginate($perPage, $pageName, $page);

        $data = $paginator->toArray();

        return new Paginator(
            (new Decorator())->decorate($this->model->newCollection($paginator->items())),
            $data['per_page'],
            $data['current_page']
        );
    }

    /**
     * Get the entries.
     *
     * @return Collection
     */
    public function get()
    {
        return (new Decorator())->decorate($this->model->newCollection($this->query->get()->all()));
    }

    /**
     * Get the first entry.
     *
     * @return Presenter
     */
    public function first()
    {
        return (new Decorator())->decorate($this->query->first());
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
        if ($this->hasHook($name)) {
            return $this->call($name, $arguments);
        }

        call_user_func_array([$this->query, $name], $arguments);

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
