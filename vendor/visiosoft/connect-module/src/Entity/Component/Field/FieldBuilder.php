<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldTypeBuilder
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldBuilder
{

    /**
     * The field reader.
     *
     * @var FieldInput
     */
    protected $input;

    /**
     * The field type builder.
     *
     * @var FieldTypeBuilder
     */
    protected $builder;

    /**
     * The field factory.
     *
     * @var FieldFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new FieldTypeBuilder instance.
     *
     * @param FieldInput   $input
     * @param FieldFactory $factory
     */
    public function __construct(FieldInput $input, FieldFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the fields.
     *
     * @param EntityBuilder $builder
     */
    public function build(EntityBuilder $builder)
    {
        $skips  = $builder->getSkips();
        $stream = $builder->getEntityStream();
        $entry  = $builder->getEntityEntry();

        $this->input->read($builder);

        /**
         * Convert each field to a field object
         * and put to the entities field collection.
         */
        foreach ($builder->getFields() as $field) {

            // Continue if skipping.
            if (in_array($field['field'], $skips)) {
                continue;
            }

            // Continue if not enabled.
            if (!array_get($field, 'enabled', true)) {
                continue;
            }

            $builder->addEntityField($this->factory->make($field, $stream, $entry));
        }
    }
}
