<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldTypeBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
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
     * @param FormBuilder $builder
     */
    public function build(FormBuilder $builder)
    {
        $skips  = $builder->getSkips();
        $stream = $builder->getFormStream();
        $entry  = $builder->getFormEntry();

        $this->input->read($builder);

        /*
         * Convert each field to a field object
         * and put to the forms field collection.
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

            $builder->addFormField($this->factory->make($field, $stream, $entry));
        }
    }
}
