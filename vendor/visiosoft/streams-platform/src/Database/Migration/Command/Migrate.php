<?php namespace Anomaly\Streams\Platform\Database\Migration\Command;

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Field\FieldMigrator;
use Anomaly\Streams\Platform\Database\Migration\Stream\StreamMigrator;
use Anomaly\Streams\Platform\Database\Migration\Assignment\AssignmentMigrator;

class Migrate
{

    /**
     * The migration.
     *
     * @var Migration
     */
    protected $migration;

    /**
     * Create a new Migrate instance.
     *
     * @param Migration $migration
     */
    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    /**
     * Handle the command.
     *
     * @param FieldMigrator      $fields
     * @param StreamMigrator     $streams
     * @param AssignmentMigrator $assignments
     */
    public function handle(
        FieldMigrator $fields,
        StreamMigrator $streams,
        AssignmentMigrator $assignments
    ) {
        $fields->migrate($this->migration);
        $streams->migrate($this->migration);
        $assignments->migrate($this->migration);
    }
}
