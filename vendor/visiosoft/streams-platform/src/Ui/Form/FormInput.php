<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Http\Request;

/**
 * Class FormInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormInput
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new FormInput instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return all the input from the form.
     *
     * @param  FormBuilder $builder
     * @return array
     */
    public function all(FormBuilder $builder)
    {
        $input = [];

        /* @var FieldType $field */
        foreach ($builder->getEnabledFormFields() as $field) {
            $input[$field->getInputName()] = $field->getValidationValue();
        }

        return $input;
    }
}
