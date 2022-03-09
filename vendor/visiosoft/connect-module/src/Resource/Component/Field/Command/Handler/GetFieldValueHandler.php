<?php namespace Visiosoft\ConnectModule\Resource\Component\Field\Command\Handler;

use Visiosoft\ConnectModule\Resource\Component\Field\Command\GetFieldValue;
use Visiosoft\ConnectModule\Resource\Component\Field\FieldValue;

/**
 * Class GetFieldValueHandler
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field\Command
 */
class GetFieldValueHandler
{

    /**
     * The value utility.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Field\FieldValue
     */
    protected $value;

    /**
     * Create a new GetFieldValueHandler instance.
     *
     * @param FieldValue $value
     */
    public function __construct(FieldValue $value)
    {
        $this->value = $value;
    }

    /**
     * Handle the command.
     *
     * @param GetFieldValue $command
     * @return mixed
     */
    public function handle(GetFieldValue $command)
    {
        $entry    = $command->getEntry();
        $resource = $command->getResource();
        $field    = $command->getField();

        return $this->value->make($resource, $field, $entry);
    }
}
