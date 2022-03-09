<?php namespace Anomaly\Streams\Platform\Field\Event;

use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Class FieldWasDeleted
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldWasDeleted
{

    /**
     * The field object.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new FieldWasDeleted instance.
     *
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field)
    {
        $this->field = $field;
    }

    /**
     * Get the field object.
     *
     * @return FieldInterface
     */
    public function getField()
    {
        return $this->field;
    }
}
