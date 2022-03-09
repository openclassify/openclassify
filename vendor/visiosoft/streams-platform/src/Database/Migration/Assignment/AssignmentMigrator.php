<?php namespace Anomaly\Streams\Platform\Database\Migration\Assignment;

use Anomaly\Streams\Platform\Field\FieldInterface;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Database\Migration\Assignment\AssignmentInput;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

class AssignmentMigrator
{
    /**
     * The assignment input reader.
     *
     * @var AssignmentInput
     */
    protected $input;

    /**
     * The fields repository.
     *
     * @var FieldRepositoryInterface
     */
    protected $fields;

    /**
     * The stream repository.
     *
     * @var StreamRepositoryInterface
     */
    protected $streams;

    /**
     * The assignment repository.
     *
     * @var AssignmentRepositoryInterface
     */
    protected $assignments;

    /**
     * Create a new AssignmentMigrator instance.
     *
     * @param AssignmentInput               $input
     * @param FieldRepositoryInterface      $fields
     * @param StreamRepositoryInterface     $streams
     * @param AssignmentRepositoryInterface $assignments
     */
    public function __construct(AssignmentInput $input, FieldRepositoryInterface $fields, StreamRepositoryInterface $streams, AssignmentRepositoryInterface $assignments)
    {
        $this->input       = $input;
        $this->fields      = $fields;
        $this->streams     = $streams;
        $this->assignments = $assignments;
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

        $assignments = $migration->getAssignments();

        $stream = $this->streams->findBySlugAndNamespace(
            array_get($stream, 'slug'),
            array_get($stream, 'namespace')
        );

        if (!$stream) {
            return;
        }

        foreach ($assignments as $assignment) {
            $namespace = array_get($assignment, 'namespace', $stream->getNamespace());

            /*
             * Make sure that we can find the
             * field before we try assigning it.
             *
             * @var FieldInterface
             */
            if (!$field = $this->fields->findBySlugAndNamespace($assignment['field'], $namespace)) {
                continue;
            }

            $assignment['field']  = $field;
            $assignment['stream'] = $stream;

            /*
             * Remove namespace assignment so it's not treated
             * as a column name in creation step
             */
            array_forget($assignment, 'namespace');

            /*
             * Check if the field is already
             * assigned to the stream first.
             */
            if ($this->assignments->findByStreamAndField($stream, $field)) {
                continue;
            }

            $this->assignments->create($assignment);
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

        if (!$stream = $migration->getStream()) {
            return;
        }

        $assignments = $migration->getAssignments();

        $stream = $this->streams->findBySlugAndNamespace(
            array_get($stream, 'slug'),
            array_get($stream, 'namespace')
        );

        if (!$stream) {
            return;
        }

        foreach ($assignments as $assignment) {

            /*
             * If there is no field to be
             * found then the assignment
             * needs to be cleaned out.
             *
             * @var FieldInterface
             */
            if (!$field = $this->fields->findBySlugAndNamespace($assignment['field'], $stream->getNamespace())) {
                continue;
            }

            $assignment['field']  = $field;
            $assignment['stream'] = $stream;

            /*
             * Check if the field is already
             * assigned to the stream and
             * then go ahead and delete.
             */
            if ($assignment = $this->assignments->findByStreamAndField($stream, $field)) {
                $this->assignments->delete($assignment);
            }
        }
    }
}
