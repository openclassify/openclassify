<?php namespace Anomaly\Streams\Platform\Field\Form\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class GetConfigFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetConfigFields
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * The field type object.
     *
     * @var FieldType
     */
    protected $fieldType;

    /**
     * Create a new GetConfigFields instance.
     *
     * @param FieldType $fieldType
     */
    public function __construct(FormBuilder $builder, FieldType $fieldType)
    {
        $this->builder   = $builder;
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     *
     * @param Evaluator $evaluator
     */
    public function handle(Evaluator $evaluator)
    {
        if (!$fields = config($this->fieldType->getNamespace('config/config'))) {
            $fields = config($this->fieldType->getNamespace('config'), []);
        }

        $fields = $evaluator->evaluate($fields);

        foreach ($fields as $slug => $field) {

            /*
             * Determine the field label.
             */
            $label = $this->fieldType->getNamespace('config.' . $slug . '.label');

            if (!trans()->has($label)) {
                $label = $this->fieldType->getNamespace('config.' . $slug . '.name');
            }

            $field['label'] = array_get($field, 'label', $label);

            /*
             * Determine the instructions.
             */
            $instructions = $this->fieldType->getNamespace('config.' . $slug . '.instructions');

            if (trans()->has($instructions)) {
                $field['instructions'] = $instructions;
            }

            /*
             * Determine the placeholder.
             */
            $placeholder = $this->fieldType->getNamespace('config.' . $slug . '.placeholder');

            if (trans()->has($placeholder)) {
                $field['placeholder'] = $placeholder;
            }

            /*
             * Determine the warning.
             */
            $warning = $this->fieldType->getNamespace('config.' . $slug . '.warning');

            if (trans()->has($warning)) {
                $field['warning'] = $warning;
            }

            /*
             * Set the configuration value.
             */
            $field['value'] = array_get($this->fieldType->getConfig(), $slug);

            // Prefix the slugs.
            $field['field'] = 'config__' . $slug;

            $fields['config__' . $slug] = $field;

            $this->builder->addField($field);
        }
    }
}
