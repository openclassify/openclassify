<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class FieldBuilder
 *

 * @package Visiosoft\ConnectModule\Resource\Component\Field
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
     * The field value.
     *
     * @var FieldValue
     */
    protected $value;

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
     * Create a new FieldBuilder instance.
     *
     * @param FieldInput   $input
     * @param FieldValue   $value
     * @param FieldFactory $factory
     * @param Evaluator    $evaluator
     */
    public function __construct(
        FieldInput $input,
        FieldValue $value,
        FieldFactory $factory,
        Evaluator $evaluator
    ) {
        $this->input     = $input;
        $this->value     = $value;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the fields.
     *
     * @param ResourceBuilder $builder
     * @param                 $entry
     * @return FieldCollection
     */
    public function build(ResourceBuilder $builder, $entry)
    {
        $resource = $builder->getResource();

        $fields = new FieldCollection();

        $this->input->read($builder, $entry);

        foreach ($builder->getFields() as $field) {

            array_set($field, 'entry', $entry);

            $field = $this->evaluator->evaluate($field, compact('entry', 'resource'));

            $field['value'] = $this->value->make($resource, $field, $entry);

            $fields->push($this->factory->make($field));
        }

        return $fields;
    }
}
