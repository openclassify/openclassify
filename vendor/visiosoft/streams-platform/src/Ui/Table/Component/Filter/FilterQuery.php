<?php

namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Container\Container;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;

/**
 * Class FilterQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilterQuery
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new FilterQuery instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Modify the table's query using the filters.
     *
     * @param TableBuilder    $builder
     * @param FilterInterface $filter
     * @param Builder         $query
     */
    public function filter(TableBuilder $builder, FilterInterface $filter, Builder $query)
    {

        /**
         * Make sure we're including
         * only distinct results.
         */
        $query->distinct();

        /*
         * If the filter is self handling then let
         * it filter the query itself.
         */
        if (method_exists($filter, 'handle')) {
            $this->container->call([$filter, 'handle'], compact('builder', 'query', 'filter'));

            return;
        }

        $handler = $filter->getQuery();

        // Self handling implies @handle
        if (is_string($handler) && !Str::contains($handler, '@')) {
            $handler .= '@handle';
        }

        /*
         * If the handler is a callable string or Closure
         * then call it using the IoC container.
         */
        if (is_string($handler) || $handler instanceof \Closure) {
            $this->container->call($handler, compact('builder', 'query', 'filter'));
        }
    }
}
