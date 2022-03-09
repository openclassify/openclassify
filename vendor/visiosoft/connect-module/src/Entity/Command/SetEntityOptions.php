<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


class SetEntityOptions
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetEntityOptions instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
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
            $this->builder->setEntityOption($key, $value);
        }
    }
}
