<?php namespace Anomaly\DecimalFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Illuminate\Support\Fluent;

/**
 * Class DecimalFieldTypeSchema
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DecimalFieldType
 */
class DecimalFieldTypeSchema extends FieldTypeSchema
{

    /**
     * @param Blueprint           $table
     * @param AssignmentInterface $assignment
     */
    public function addColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if the column already exists.
        if ($this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        /**
         * Add the column to the table.
         *
         * @var Blueprint|Fluent $column
         */
        $column = $table->{$this->fieldType->getColumnType()}(
            $this->fieldType->getColumnName(),
            array_get($this->fieldType->getConfig(), 'digits', 11),
            array_get($this->fieldType->getConfig(), 'decimals', 2)
        )->nullable(!$assignment->isTranslatable() ? !$assignment->isRequired() : true);

        if (!Str::contains($this->fieldType->getColumnType(), ['text', 'blob'])) {
            $column->default(array_get($this->fieldType->getConfig(), 'default_value'));
        }

        // Mark the column unique if desired and not translatable.
        if ($assignment->isUnique() && !$assignment->isTranslatable()) {
            $table->unique($this->fieldType->getColumnName());
        }
    }
}
