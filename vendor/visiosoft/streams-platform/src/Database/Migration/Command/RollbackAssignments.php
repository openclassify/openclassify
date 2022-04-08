<?php namespace Anomaly\Streams\Platform\Database\Migration\Command;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class RollbackAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RollbackAssignments
{

    /**
     * The migration.
     *
     * @var Migration
     */
    protected $migration;

    /**
     * Create a new RollbackAssignments instance.
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
     * @param FieldRepositoryInterface      $fields
     * @param StreamRepositoryInterface     $streams
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        AssignmentRepositoryInterface $assignments
    ) {
        $addon  = $this->migration->getAddon();
        $stream = $this->migration->getStream();

        $namespace = array_get($stream, 'namespace', $this->migration->getNamespace());
        $slug      = array_get($stream, 'slug', $addon ? $addon->getSlug() : null);

        $stream = $streams->findBySlugAndNamespace($slug, $namespace);

        foreach ($this->migration->getAssignments() as $field => $assignment) {
            if (is_numeric($field)) {
                $field = $assignment;
            }

            if ($stream && $field = $fields->findBySlugAndNamespace($field, $namespace)) {
                if ($assignment = $assignments->findByStreamAndField($stream, $field)) {
                    $assignments->delete($assignment);
                }
            }
        }

        $assignments->cleanup();
    }
}
