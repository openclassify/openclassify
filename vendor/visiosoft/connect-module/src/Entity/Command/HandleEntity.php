<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class HandleEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class HandleEntity
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new HandleEntity instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     *
     * @param Container $container
     */
    public function handle(Container $container)
    {
        if ($this->builder->hasEntityErrors()) {
            return;
        }

        $handler = $this->builder->getHandler();

        if ($handler && !str_contains($handler, '@') && class_implements($handler, SelfHandling::class)) {
            $handler .= '@handle';
        }

        $container->call($handler, ['builder' => $this->builder]);
    }
}
