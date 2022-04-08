<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;


/**
 * Class SetDefaultParameters
 *

 * @package Visiosoft\ConnectModule\Resource\Command
 */
class SetDefaultParameters
{

    /**
     * Skip these.
     *
     * @var array
     */
    protected $skips = [
        'model',
        'repository',
    ];

    /**
     * Default properties.
     *
     * @var array
     */
    protected $defaults = [

    ];

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
     * Set the resource model object from the builder's model.
     *
     * @param SetDefaultParameters $command
     */
    public function handle()
    {

        /**
         * Next we'll loop each property and look for a handler.
         */
        $reflection = new \ReflectionClass($this->builder);

        /* @var \ReflectionProperty $property */
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PROTECTED) as $property) {

            if (in_array($property->getName(), $this->skips)) {
                continue;
            }

            /**
             * If there is no getter then skip it.
             */
            if (!method_exists($this->builder, $method = 'get' . ucfirst($property->getName()))) {
                continue;
            }

            /**
             * If the parameter already
             * has a value then skip it.
             */
            if ($this->builder->{$method}()) {
                continue;
            }

            /**
             * Check if we can transform the
             * builder property into a handler.
             * If it exists, then go ahead and use it.
             */
            $handler = str_replace(
                'ResourceBuilder',
                'Resource' . ucfirst($property->getName()),
                get_class($this->builder)
            );

            if (class_exists($handler)) {

                /**
                 * Make sure the handler is
                 * formatted properly.
                 */
                if (!str_contains($handler, '@')) {
                    $handler .= '@handle';
                }

                $this->builder->{'set' . ucfirst($property->getName())}($handler);

                continue;
            }

            /**
             * If the handler does not exist and
             * we have a default handler, use it.
             */
            if ($default = array_get($this->defaults, $property->getName())) {
                $this->builder->{'set' . ucfirst($property->getName())}($default);
            }
        }
    }
}
