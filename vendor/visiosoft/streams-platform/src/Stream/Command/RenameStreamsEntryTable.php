<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Stream\StreamSchema;

/**
 * Class RenameStreamsEntryTable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenameStreamsEntryTable
{

    /**
     * The stream interface.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new RenameStreamsEntryTable instance.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Handle the command.
     *
     * @param StreamSchema $schema
     */
    public function handle(StreamSchema $schema, StreamRepositoryInterface $streams)
    {
        /* @var StreamInterface $stream */
        $stream = $streams->find($this->stream->getId());

        $schema->renameTable($stream, $this->stream);

        if ($stream->isTranslatable()) {
            $schema->renameTranslationsTable($stream, $this->stream);
        }
    }
}
