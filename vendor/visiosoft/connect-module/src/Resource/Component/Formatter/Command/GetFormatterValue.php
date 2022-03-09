<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter\Command;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Contract\FormatterInterface;
use Visiosoft\ConnectModule\Resource\Resource;

/**
 * Class GetFormatterValue
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class GetFormatterValue
{

    /**
     * The resource object.
     *
     * @var \Visiosoft\ConnectModule\Resource\Resource
     */
    protected $resource;

    /**
     * The formatter object.
     *
     * @var \Visiosoft\ConnectModule\Resource\Component\Formatter\Contract\FormatterInterface
     */
    protected $formatter;

    /**
     * The entry object.
     *
     * @var mixed
     */
    protected $entry;

    /**
     * Create a new GetFormatterValue instance.
     *
     * @param Resource           $resource
     * @param FormatterInterface $formatter
     * @param                    $entry
     */
    function __construct(Resource $resource, FormatterInterface $formatter, $entry)
    {
        $this->entry     = $entry;
        $this->resource  = $resource;
        $this->formatter = $formatter;
    }

    /**
     * Get the formatter object.
     *
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
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
