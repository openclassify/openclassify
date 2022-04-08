<?php namespace Anomaly\Streams\Platform\Database\Migration\Command;

use Illuminate\Cache\CacheManager;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Database\Migration\Field\FieldMigrator;
use Anomaly\Streams\Platform\Database\Migration\Stream\StreamMigrator;
use Anomaly\Streams\Platform\Database\Migration\Assignment\AssignmentMigrator;

class Reset
{

    /**
     * The migration.
     *
     * @var Migration
     */
    protected $migration;

    /**
     * Create a new Rollback instance.
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
     * @param CacheManager       $cache
     * @param FieldMigrator      $fields
     * @param StreamMigrator     $streams
     * @param AssignmentMigrator $assignments
     */
    public function handle(
        CacheManager $cache,
        FieldMigrator $fields,
        StreamMigrator $streams,
        AssignmentMigrator $assignments
    ) {
        $assignments->reset($this->migration);
        $fields->reset($this->migration);
        $streams->reset($this->migration);

        $cache->flush();
    }
}
