<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\Ui\Entity\EntityHandler;
use Anomaly\Streams\Platform\Ui\Entity\EntityValidator;


/**
 * Class SetDefaultParameters
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Command
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
        'handler' => EntityHandler::class,
        'validator' => EntityValidator::class,
    ];

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntityColumnsCommand instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the entity model object from the builder's model.
     *
     * @param SetDefaultParameters $command
     */
    public function handle()
    {
        /**
         * Set the entity mode according
         * to the builder's entry.
         */
        if (!$this->builder->getEntityMode()) {
            $this->builder->setEntityMode($this->builder->getEntry() ? 'edit' : 'create');
        }

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
             * Check if we can transentity the
             * builder property into a handler.
             * If it exists, then go ahead and use it.
             */
            $handler = str_replace(
                'EntityBuilder',
                'Entity' . ucfirst($property->getName()),
                get_class($this->builder)
            );

            if (class_exists($handler)) {

                /**
                 * Make sure the handler is
                 * entityatted properly.
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
