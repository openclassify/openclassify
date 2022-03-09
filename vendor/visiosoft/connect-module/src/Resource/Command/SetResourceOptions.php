<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Support\Resolver;


/**
 * Class SetResourceOptions
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class SetResourceOptions
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new SetResourceOptions instance.
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
     * @param Resolver  $resolver
     * @param Evaluator $evaluator
     */
    public function handle(Resolver $resolver, Evaluator $evaluator)
    {
        $evaluator->evaluate(
            $resolver->resolve($this->builder->getOptions(), ['builder' => $this->builder]),
            ['builder' => $this->builder]
        );

        foreach ($this->builder->getOptions() as $key => $value) {
            $this->builder->setResourceOption($key, $value);
        }
    }
}
