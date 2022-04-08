<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Stream\StreamSchema;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

class DropStreamsEntryTable
{

    /**
     * The stream interface.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new DropStreamsEntryTable instance.
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
    public function handle(StreamSchema $schema)
    {
        $table = $this->stream->getEntryTableName();

        $schema->dropTable($table);

        if ($this->stream->isTranslatable()) {
            $table = $this->stream->getEntryTranslationsTableName();

            $schema->dropTable($table);
        }
    }
}
