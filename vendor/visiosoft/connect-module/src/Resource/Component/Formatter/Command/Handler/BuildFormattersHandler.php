<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter\Command\Handler;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Command\BuildFormatters;
use Visiosoft\ConnectModule\Resource\Component\Formatter\FormatterBuilder;

/**
 * Class BuildFormattersHandler
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter\Listener\Command
 */
class BuildFormattersHandler
{

    /**
     * The formatter builder.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Formatter\FormatterBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormattersHandler instance.
     *
     * @param FormatterBuilder $builder
     */
    public function __construct(FormatterBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build formatters and load them to the resource.
     *
     * @param BuildFormatters $command
     */
    public function handle(BuildFormatters $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
