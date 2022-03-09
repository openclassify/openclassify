<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

class AssignmentSchema
{

    /**
     * The schema builder object.
     *
     * @var Builder
     */
    protected $schema;

    /**
     * Create a new AssignmentSchema instance.
     */
    public function __construct()
    {
        $this->schema = app('db')->connection()->getSchemaBuilder();
    }

    /**
     * Add a column.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function addColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->addColumn($table, $assignment);
            }
        );
    }

    /**
     * Add a column index.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function addIndex($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->addIndex($table, $assignment);
            }
        );
    }

    /**
     * Update a column.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function updateColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->updateColumn($table, $assignment);
            }
        );
    }

    /**
     * Update a column index.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function updateIndex($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->updateIndex($table, $assignment);
            }
        );
    }

    /**
     * Rename a column.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function renameColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();
        $from   = $assignment->getFieldType(true);

        if ($from->getColumnName() === $type->getColumnName()) {
            return;
        }

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $from, $assignment) {
                $schema->renameColumn($table, $from);
                $schema->updateIndex($table, $assignment);
            }
        );
    }

    /**
     * Change a column.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function changeColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();
        $from   = $assignment->getFieldType(true);

        if ($from->getColumnType() === false || $type->getColumnType() === false) {
            return;
        }

        if ($from->getColumnType() === $type->getColumnType()) {
            return;
        }

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->updateColumn($table, $assignment);
            }
        );
    }

    /**
     * Drop a column.
     *
     * @param           $table
     * @param FieldType $type
     */
    public function dropColumn($table, FieldType $type)
    {
        $schema = $type->getSchema();

        if (!$this->schema->hasTable($table)) {
            return;
        }

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema) {
                $schema->dropColumn($table);
            }
        );
    }

    /**
     * Drop a column index.
     *
     * @param           $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function dropIndex($table, FieldType $type, AssignmentInterface $assignment)
    {
        $schema = $type->getSchema();

        if (!$this->schema->hasTable($table)) {
            return;
        }

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->dropIndex($table, $assignment);
            }
        );
    }

    /**
     * Backup a column's data.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function backupColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        if (!$this->schema->hasTable($table)) {
            return;
        }

        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->backupColumn($table, $assignment);
            }
        );
    }

    /**
     * Restore a column's data.
     *
     * @param $table
     * @param FieldType $type
     * @param AssignmentInterface $assignment
     */
    public function restoreColumn($table, FieldType $type, AssignmentInterface $assignment)
    {
        if (!$this->schema->hasTable($table)) {
            return;
        }

        $schema = $type->getSchema();

        $this->schema->table(
            $table,
            function (Blueprint $table) use ($schema, $assignment) {
                $schema->restoreColumn($table, $assignment);
            }
        );
    }
}
