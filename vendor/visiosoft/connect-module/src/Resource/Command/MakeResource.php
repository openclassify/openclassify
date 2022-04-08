<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class MakeResource
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class MakeResource
{

    use DispatchesJobs;

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new MakeResource instance.
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
     * @param Container $container
     */
    public function handle(Container $container)
    {
        $resource = $this->builder->getResource();

        if ($handler = $this->builder->getResourceOption('data')) {

            // Self handling implies @handle
            if (is_string($handler) && !str_contains($handler, '@')) {
                $handler .= '@handle';
            }

            $container->call($handler, compact('resource'));
        }

        // Make sure entries are in there.
        if (!$this->builder->getResourceDataItem('entries')) {
            $this->dispatch(new AddEntriesData($this->builder));
        }
    }
}
