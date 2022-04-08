<?php namespace Visiosoft\ConnectModule\Resource\Event;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ResourceIsQuerying
 *

 * @package       Visiosoft\ConnectModule\Resource\Event
 */
class ResourceIsQuerying
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * The resource query.
     *
     * @var Builder
     */
    protected $query;

    /**
     * Create a new ResourceIsQuerying instance.
     *
     * @param ResourceBuilder $builder
     * @param Builder         $query
     */
    public function __construct(ResourceBuilder $builder, Builder $query)
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
     * Get the resource.
     *
     * @return ResourceBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
