<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class LoadEntityValues
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class LoadEntityValues
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new LoadEntityValues instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $entity = $this->builder->getEntity();

        /* @var FieldType $field */
        foreach ($entity->getEnabledFields() as $field) {
            $entity->setValue($field->getInputName(), $field->getInputValue());
        }
    }
}
