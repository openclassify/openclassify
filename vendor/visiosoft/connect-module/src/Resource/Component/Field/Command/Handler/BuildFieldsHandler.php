<?php namespace Visiosoft\ConnectModule\Resource\Component\Field\Command\Handler;

use Visiosoft\ConnectModule\Resource\Component\Field\Command\BuildFields;
use Visiosoft\ConnectModule\Resource\Component\Field\FieldBuilder;

/**
 * Class BuildFieldsHandler
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field\Listener\Command
 */
class BuildFieldsHandler
{

    /**
     * The field builder.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Field\FieldBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFieldsHandler instance.
     *
     * @param FieldBuilder $builder
     */
    public function __construct(FieldBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build fields and load them to the resource.
     *
     * @param BuildFields $command
     */
    public function handle(BuildFields $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
