<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class BuildFormatters
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter\Command
 */
class BuildFormatters
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormatters instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the resource builder.
     *
     * @return ResourceBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
