<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Illuminate\Http\Request;

/**
 * Class EntityInput
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityInput
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new EntityInput instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return all the input from the entity.
     *
     * @param EntityBuilder $builder
     * @return array
     */
    public function all(EntityBuilder $builder)
    {
        $input = [];

        /* @var FieldType $field */
        foreach ($builder->getEnabledEntityFields() as $field) {
            $input[$field->getInputName()] = $field->getValidationValue();
        }

        return $input;
    }
}
