<?php namespace Visiosoft\ConnectModule\Resource\Component\Field\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;

/**
 * Class BuildFields
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field\Command
 */
class BuildFields
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFields instance.
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
