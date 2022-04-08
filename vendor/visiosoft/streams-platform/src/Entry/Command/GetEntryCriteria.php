<?php namespace Anomaly\Streams\Platform\Entry\Command;

use Anomaly\Streams\Platform\Entry\EntryFactory;

/**
 * Class GetEntryCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetEntryCriteria
{

    /**
     * The getter method.
     *
     * @var string
     */
    protected $method;

    /**
     * The stream slug.
     *
     * @var string
     */
    protected $stream;

    /**
     * The stream namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Create a new GetEntryCriteria instance.
     *
     * @param $namespace
     * @param $stream
     */
    public function __construct($namespace, $stream, $method = 'get')
    {
        $this->method    = $method;
        $this->stream    = $stream;
        $this->namespace = $namespace;
    }

    /**
     * Handle the command.
     *
     * @param  EntryFactory                                  $factory
     * @return \Anomaly\Streams\Platform\Entry\EntryCriteria
     */
    public function handle(EntryFactory $factory)
    {
        return $factory->make($this->namespace, $this->stream, $this->method);
    }
}
