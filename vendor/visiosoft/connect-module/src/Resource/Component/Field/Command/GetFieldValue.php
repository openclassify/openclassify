<?php namespace Visiosoft\ConnectModule\Resource\Component\Field\Command;

use Visiosoft\ConnectModule\Resource\Component\Field\Contract\FieldInterface;
use Visiosoft\ConnectModule\Resource\Resource;

/**
 * Class GetFieldValue
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class GetFieldValue
{

    /**
     * The resource object.
     *
     * @var \Visiosoft\ConnectModule\Resource\Resource
     */
    protected $resource;

    /**
     * The field object.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Field\Contract\FieldInterface
     */
    protected $field;

    /**
     * The entry object.
     *
     * @var mixed
     */
    protected $entry;

    /**
     * Create a new GetFieldValue instance.
     *
     * @param Resource           $resource
     * @param FieldInterface     $field
     * @param                    $entry
     */
    function __construct(Resource $resource, FieldInterface $field, $entry)
    {
        $this->entry    = $entry;
        $this->resource = $resource;
        $this->field    = $field;
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

    /**
     * Get the resource object.
     *
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get the entry object.
     *
     * @return mixed
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
