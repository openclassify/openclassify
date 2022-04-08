<?php namespace Anomaly\Streams\Platform\Database\Migration\Stream;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

class StreamMigrator
{

    /**
     * The stream input reader.
     *
     * @var StreamInput
     */
    protected $input;

    /**
     * The stream repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * Create a new StreamMigrator instance.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function __construct(StreamInput $input, StreamRepositoryInterface $streams)
    {
        $this->input   = $input;
        $this->streams = $streams;
    }

    /**
     * Migrate the migration.
     *
     * @param Migration $migration
     */
    public function migrate(Migration $migration)
    {
        $this->input->read($migration);

        if (!$stream = $migration->getStream()) {
            return;
        }

        if (!$this->streams->findBySlugAndNamespace($stream['slug'], $stream['namespace'])) {
            $this->streams->create($migration->getStream());
        }
    }

    /**
     * Reset the migration.
     *
     * @param Migration $migration
     */
    public function reset(Migration $migration)
    {
        $this->input->read($migration);

        if ($migration->getDelete() === false) {
            return;
        }

        /* @var EloquentModel $stream */
        if (!$stream = $migration->getStream()) {
            return;
        }

        if ($stream = $this->streams->findBySlugAndNamespace($stream['slug'], $stream['namespace'])) {
            $this->streams->delete($stream);
        }
    }
}
