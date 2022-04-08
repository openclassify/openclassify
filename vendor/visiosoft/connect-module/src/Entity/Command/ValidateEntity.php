<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class ValidateEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class ValidateEntity
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new ValidateEntity instance.
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
        $validator = $this->builder->getValidator();

        /**
         * If it's self handling just add @handle
         */
        if ($validator && !str_contains($validator, '@') && class_implements($validator, SelfHandling::class)) {
            $validator .= '@handle';
        }

        /**
         * If the validator is a string or Closure then it's a handler
         * and we and can resolve it through the service container.
         */
        if (is_string($validator) || $validator instanceof \Closure) {
            $container->call($validator, ['builder' => $this->builder]);
        }
    }
}
