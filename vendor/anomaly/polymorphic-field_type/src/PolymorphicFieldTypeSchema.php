<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class PolymorphicFieldTypeSchema
 *
 * @link          http://pyrocms.com
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PolymorphicFieldTypeSchema extends FieldTypeSchema
{

    /**
     * Add the field type columns.
     *
     * @param Blueprint           $table
     * @param AssignmentInterface $assignment
     */
    public function addColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName() . '_id')) {
            $table->integer($this->fieldType->getColumnName() . '_id')->nullable(
                !$assignment->isRequired()
            );
        }
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName() . '_type')) {
            $table->string($this->fieldType->getColumnName() . '_type')->nullable(
                !$assignment->isRequired()
            );
        }

        if ($assignment->isUnique() && $assignment->isTranslatable()) {
            $table->unique(
                [
                    $this->fieldType->getColumnName() . '_type',
                    $this->fieldType->getColumnName() . '_id',
                ]
            );
        }
    }

    /**
     * Update the field type columns.
     *
     * @param Blueprint           $table
     * @param AssignmentInterface $assignment
     */
    public function updateColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if the column exists.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName() . '_id')) {
            return;
        }

        $table->string($this->fieldType->getColumnName() . '_type')->nullable(
            !$assignment->isRequired()
        )->change();

        $table->integer($this->fieldType->getColumnName() . '_id')->nullable(
            !$assignment->isRequired()
        )->change();

        if ($assignment->isUnique() && $assignment->isTranslatable()) {
            $table->unique(
                [
                    $this->fieldType->getColumnName() . '_type',
                    $this->fieldType->getColumnName() . '_id',
                ]
            );
        }
    }

    /**
     * Rename the column.
     *
     * @param Blueprint $table
     * @param FieldType $from
     */
    public function renameColumn(Blueprint $table, FieldType $from)
    {
        $table->renameColumn($from->getColumnName() . '_type', $this->fieldType->getColumnName() . '_type');
        $table->renameColumn($from->getColumnName() . '_id', $this->fieldType->getColumnName() . '_id');
    }

    /**
     * Drop the field type column.
     *
     * @param Blueprint $table
     */
    public function dropColumn(Blueprint $table)
    {
        $table->dropColumn($this->fieldType->getColumnName() . '_type');
        $table->dropColumn($this->fieldType->getColumnName() . '_id');
    }
}
