<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Contracts\Container\Container;
use Illuminate\Validation\Factory;

/**
 * Class EntityExtender
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityExtender
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new EntityExtender instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Extend the validation factory.
     *
     * @param Factory       $factory
     * @param EntityBuilder $builder
     */
    public function extend(Factory $factory, EntityBuilder $builder)
    {
        foreach ($builder->getEntityFields() as $fieldType) {
            $this->registerValidators($factory, $builder, $fieldType);
        }
    }

    /**
     * Register field's custom validators.
     *
     * @param Factory       $factory
     * @param EntityBuilder $builder
     * @param FieldType     $fieldType
     */
    protected function registerValidators(Factory $factory, EntityBuilder $builder, FieldType $fieldType)
    {
        foreach ($fieldType->getValidators() as $rule => $validator) {

            $handler = array_get($validator, 'handler');

            if (class_exists($handler) && class_implements($handler, 'Illuminate\Contracts\Bus\SelfHandling')) {
                $handler .= '@handle';
            }

            $factory->extend(
                $rule,
                function ($attribute, $value, $parameters) use ($handler, $builder) {
                    return $this->container->call(
                        $handler,
                        compact('attribute', 'value', 'parameters', 'builder')
                    );
                },
                array_get($validator, 'message')
            );
        }
    }
}
