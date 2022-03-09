<?php namespace Visiosoft\ConnectModule\Resource\Component\Result\Command;

use Visiosoft\ConnectModule\Resource\Component\Result\ResultBuilder;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;


/**
 * Class BuildResults
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Result\Command
 */
class BuildResults
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResults instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResultBuilder $builder
     */
    public function handle(ResultBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
