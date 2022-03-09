<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Hydrator;
use Illuminate\Http\Request;

/**
 * Class HydrateFromRequest
 *

 * @package Visiosoft\ConnectModule\Resource\Command
 */
class HydrateFromRequest
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResourceFormattersCommand instance.
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
     * @param Hydrator $hydrator
     * @throws \Exception
     */
    public function handle(Hydrator $hydrator, Request $request)
    {
        $functional_options = $this->builder->getOptions();

        $hydrator->hydrate($this->builder, $request->all());

        // include functional options
        foreach ($functional_options as $key => $option) {
            $this->builder->setOption($key, $option);
        }
    }
}
