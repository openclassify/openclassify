<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class RepopulateFields
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class RepopulateFields
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new RepopulateFields instance.
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
        /* @var FieldType $field */
        foreach ($this->builder->getEntityFields() as $field) {
            $field->setValue($field->getPostValue());
        }
    }
}
