<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;


/**
 * Class SetResourceModel
 *

 * @package Visiosoft\ConnectModule\Resource\Command
 */
class SetResourceModel
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
     */
    public function handle()
    {
        $resource = $this->builder->getResource();
        $model    = $this->builder->getModel();

        /**
         * If the model is already instantiated
         * then use it as is.
         */
        if (is_object($model)) {

            $resource->setModel($model);

            return;
        }

        /**
         * If no model is set, try guessing the
         * model based on best practices.
         */
        if ($model === null) {

            $stream    = ucfirst(camel_case($this->builder->getStream()));
            $namespace = ucfirst(camel_case($this->builder->getNamespace()));

            if (!$stream || !$namespace) {
                throw new \Exception('You must provide a model or stream and namespace parameter!');
            }

            $model = 'Anomaly\Streams\Platform\Model\\' . $namespace . '\\' . $namespace . $stream . 'EntryModel';

            $this->builder->setModel($model);
        }

        /**
         * If the model does not exist or
         * is disabled then skip it.
         */
        if (!$model || !class_exists($model)) {
            return;
        }

        /**
         * Set the model on the resource!
         */
        $resource->setModel(app($model));
    }
}
