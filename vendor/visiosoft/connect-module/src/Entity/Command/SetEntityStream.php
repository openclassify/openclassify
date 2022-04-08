<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetEntityStream
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetEntityStream
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

    public function handle()
    {
        $entity = $this->builder->getEntity();
        $model  = $this->builder->getModel();

        if (is_string($model) && !class_exists($model)) {
            return;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof EntryInterface) {
            $entity->setStream($model->getStream());
        }
    }
}
