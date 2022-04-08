<?php namespace Anomaly\Streams\Platform\Entry\Event;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class GatherParserData
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GatherParserData
{

    /**
     * The model data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new GatherParserData instance.
     *
     * @param Collection      $data
     * @param StreamInterface $stream
     */
    public function __construct(Collection $data, StreamInterface $stream)
    {
        $this->data   = $data;
        $this->stream = $stream;
    }

    /**
     * Get the data.
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the stream.
     *
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }
}
