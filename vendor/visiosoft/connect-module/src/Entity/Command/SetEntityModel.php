<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetEntityModel
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetEntityModel
{

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
     * Handle the entity.
     */
    public function handle()
    {
        $entity = $this->builder->getEntity();
        $model  = $this->builder->getModel();

        /**
         * If the model is already instantiated
         * then use it as is.
         */
        if (is_object($model)) {

            $entity->setModel($model);

            return;
        }

        /**
         * If no model is set, try guessing the
         * model based on best practices.
         */
        if ($model === null) {

            $parts = explode('\\', str_replace('EntityBuilder', 'Model', get_class($this->builder)));

            unset($parts[count($parts) - 2]);

            $model = implode('\\', $parts);

            $this->builder->setModel($model);
        }

        /**
         * If the model does not exist or
         * is disabled then skip it.
         */
        if (!$model || !class_exists($model)) {

            $this->builder->setModel(null);

            return;
        }

        /**
         * Set the model on the entity!
         */
        $entity->setModel(app($model));
    }
}
