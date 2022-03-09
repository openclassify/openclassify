<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\Component\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Support\Hydrator;

/**
 * Class FieldFactory
 *

 * @package Visiosoft\ConnectModule\Resource\Component\Field
 */
class FieldFactory
{

    /**
     * The default field class.
     *
     * @var string
     */
    protected $field = Field::class;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * Create a new FieldFactory instance.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Make a field.
     *
     * @param  array $parameters
     * @return FieldInterface
     */
    public function make(array $parameters)
    {
        $field = app()->make(array_get($parameters, 'field', $this->field), $parameters);

        $this->hydrator->hydrate($field, $parameters);

        return $field;
    }
}
