<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class GetStreams
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetStreams
{

    /**
     * The stream namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Create a new GetStreams instance.
     *
     * @param string $namespace
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Handle the command.
     *
     * @param  StreamRepositoryInterface                                      $streams
     * @return \Anomaly\Streams\Platform\Stream\Contract\StreamInterface|null
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        return $streams->findAllByNamespace($this->namespace);
    }
}
