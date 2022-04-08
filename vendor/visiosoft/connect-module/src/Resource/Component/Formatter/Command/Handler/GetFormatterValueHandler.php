<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter\Command\Handler;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Command\GetFormatterValue;
use Visiosoft\ConnectModule\Resource\Component\Formatter\FormatterValue;

/**
 * Class GetFormatterValueHandler
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter\Command
 */
class GetFormatterValueHandler
{

    /**
     * The value utility.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Formatter\FormatterValue
     */
    protected $value;

    /**
     * Create a new GetFormatterValueHandler instance.
     *
     * @param FormatterValue $value
     */
    public function __construct(FormatterValue $value)
    {
        $this->value = $value;
    }

    /**
     * Handle the command.
     *
     * @param GetFormatterValue $command
     * @return mixed
     */
    public function handle(GetFormatterValue $command)
    {
        $entry     = $command->getEntry();
        $resource  = $command->getResource();
        $formatter = $command->getFormatter();

        return $this->value->make($resource, $formatter, $entry);
    }
}
