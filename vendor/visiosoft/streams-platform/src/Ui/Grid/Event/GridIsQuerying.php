<?php namespace Anomaly\Streams\Platform\Ui\Grid\Event;

use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GridIsQuerying
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GridIsQuerying
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * The grid query.
     *
     * @var Builder
     */
    protected $query;

    /**
     * Create a new GridIsQuerying instance.
     *
     * @param GridBuilder $builder
     * @param Builder     $query
     */
    public function __construct(GridBuilder $builder, Builder $query)
    {
        $this->builder = $builder;
        $this->query   = $query;
    }

    /**
     * Get the query.
     *
     * @return Builder
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Get the grid.
     *
     * @return GridBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
