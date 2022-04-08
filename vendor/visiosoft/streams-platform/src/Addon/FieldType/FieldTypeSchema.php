<?php

namespace Anomaly\Streams\Platform\Addon\FieldType;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Fluent;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;

/**
 * Class FieldTypeSchema
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeSchema
{

    /**
     * The cache repository.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * The schema builder object.
     *
     * @var Builder
     */
    protected $schema;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The database connection.
     *
     * @var Connection
     */
    protected $connection;

    /**
     * The field type object.
     *
     * @var FieldType
     */
    protected $fieldType;

    /**
     * Create a new FieldTypeSchema instance.
     *
     * @param FieldType $fieldType
     * @param Repository $cache
     */
    public function __construct(FieldType $fieldType, Container $container, Repository $cache)
    {
        $this->cache     = $cache;
        $this->container = $container;
        $this->fieldType = $fieldType;

        $this->connection = $container->make('db')->connection();

        $this->schema = $this->connection->getSchemaBuilder();
    }

    /**
     * Add the field type column to the table.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function addColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if no column type.
        if (!$this->fieldType->getColumnType()) {
            return;
        }

        // Skip if the column already exists.
        if ($this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        /**
         * Add the column to the table.
         *
         * @var Blueprint|Fluent $column
         */
        $column = call_user_func_array(
            [$table, $this->fieldType->getColumnType()],
            array_filter(
                [
                    $this->fieldType->getColumnName(),
                    $this->fieldType->getColumnLength(),
                ]
            )
        );

        $column->nullable(!$assignment->isTranslatable() ? !$assignment->isRequired() : true);

        if (!Str::contains($this->fieldType->getColumnType(), ['text', 'blob'])) {
            $column->default(Arr::get($this->fieldType->getConfig(), 'default_value'));
        }
    }

    /**
     * Add an index for unique fields if applicable.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function addIndex(Blueprint $table, AssignmentInterface $assignment)
    {
        $connection = $this->schema->getConnection();
        $manager    = $connection->getDoctrineSchemaManager();
        $doctrine   = $manager->listTableDetails($connection->getTablePrefix() . $table->getTable());

        $unique = md5($assignment->getId());

        if ($assignment->isUnique() && !$assignment->isTranslatable() && !$doctrine->hasIndex($unique)) {
            $table->unique($this->fieldType->getColumnName(), $unique);
        }
    }

    /**
     * Update the field type column to the table.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function updateColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if no column type.
        if (!$this->fieldType->getColumnType()) {
            return;
        }

        // Skip if the column doesn't exists.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        /**
         * Update the column to the table.
         *
         * @var Blueprint|Fluent $column
         */
        $column = call_user_func_array(
            [$table, $this->fieldType->getColumnType()],
            array_filter(
                [
                    $this->fieldType->getColumnName(),
                    $this->fieldType->getColumnLength(),
                ]
            )
        );

        $column->nullable(!$assignment->isTranslatable() ? !$assignment->isRequired() : true)->change();

        if (!Str::contains($this->fieldType->getColumnType(), ['text', 'blob'])) {
            $column->default(Arr::get($this->fieldType->getConfig(), 'default_value'));
        }
    }

    /**
     * Update the field's column index.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function updateIndex(Blueprint $table, AssignmentInterface $assignment)
    {
        $connection = $this->schema->getConnection();
        $manager    = $connection->getDoctrineSchemaManager();
        $doctrine   = $manager->listTableDetails($connection->getTablePrefix() . $table->getTable());

        $unique = md5($assignment->getId());

        if ($assignment->isUnique() && !$assignment->isTranslatable() && !$doctrine->hasIndex($unique)) {
            $table->unique($this->fieldType->getColumnName(), $unique);
        }

        if (!$assignment->isUnique() && !$assignment->isTranslatable() && $doctrine->hasIndex($unique)) {
            $table->dropIndex($unique);
        }

        $unique = md5('unique_' . $table->getTable() . '_' . $this->fieldType->getColumnName());

        if (!$assignment->isUnique() && !$assignment->isTranslatable() && $doctrine->hasIndex($unique)) {
            $table->dropIndex($unique);
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
        if ($this->fieldType->getColumnType() === false) {
            return;
        }

        $table->renameColumn($from->getColumnName(), $this->fieldType->getColumnName());
    }

    /**
     * Change the column type.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function changeColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if the column doesn't exists.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        /**
         * Update the column to the table.
         *
         * @var Blueprint|Fluent $column
         */
        $column = call_user_func_array(
            [$table, $this->fieldType->getColumnType()],
            array_filter(
                [
                    $this->fieldType->getColumnName(),
                    $this->fieldType->getColumnLength(),
                ]
            )
        );

        $column->nullable(!$assignment->isTranslatable() ? !$assignment->isRequired() : true)->change();

        if (!Str::contains($this->fieldType->getColumnType(), ['text', 'blob'])) {
            $column->default(Arr::get($this->fieldType->getConfig(), 'default_value'));
        }
    }

    /**
     * Drop the field type column from the table.
     *
     * @param Blueprint $table
     */
    public function dropColumn(Blueprint $table)
    {
        // Skip if no column type.
        if (!$this->fieldType->getColumnType()) {
            return;
        }

        // Skip if the column doesn't exist.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        // Drop dat 'ole column.
        $table->dropColumn($this->fieldType->getColumnName());
    }

    /**
     * Drop the field's column index.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function dropIndex(Blueprint $table, AssignmentInterface $assignment)
    {
        $connection = $this->schema->getConnection();
        $manager    = $connection->getDoctrineSchemaManager();
        $doctrine   = $manager->listTableDetails($connection->getTablePrefix() . $table->getTable());

        $unique = md5($assignment->getId());

        if ($doctrine->hasIndex($unique)) {
            $table->dropIndex($unique);
        }

        $unique = md5('unique_' . $table->getTable() . '_' . $this->fieldType->getColumnName());

        if ($doctrine->hasIndex($unique)) {
            $table->dropIndex($unique);
        }
    }

    /**
     * Backup the field type column to cache.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function backupColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if no column type.
        if (!$this->fieldType->getColumnType()) {
            return;
        }

        // Skip if the column doesn't exist.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        // Translatable or no?
        $translatable = ends_with($table->getTable(), '_translations');

        // Back dat data up.
        if ($translatable) {

            $results = $this->connection
                ->table($table->getTable())
                ->select(['entry_id', $this->fieldType->getColumnName()])
                ->groupBy($table->getTable() . '.entry_id')
                ->where(
                    function (\Illuminate\Database\Query\Builder $query) use ($table) {
                        $query->where($table->getTable() . '.locale', config('app.locale'));
                        $query->orWhere(
                            $table->getTable() . '.locale',
                            config('app.fallback_locale')
                        );
                        $query->orWhereNull($table->getTable() . '.locale');
                    }
                )
                ->get();
        } else {

            $results = $this->connection
                ->table($table->getTable())
                ->select(['id', $this->fieldType->getColumnName()])
                ->get();
        }

        $this->cache->forever(__CLASS__ . $this->fieldType->getColumnName(), $results);
    }

    /**
     * Restore the field type column to cache.
     *
     * @param Blueprint $table
     * @param AssignmentInterface $assignment
     */
    public function restoreColumn(Blueprint $table, AssignmentInterface $assignment)
    {
        // Skip if no column type.
        if (!$this->fieldType->getColumnType()) {
            return;
        }

        // Skip if the column doesn't exist.
        if (!$this->schema->hasColumn($table->getTable(), $this->fieldType->getColumnName())) {
            return;
        }

        // Translatable or no?
        $translatable = ends_with($table->getTable(), '_translations');

        // Restore the data.
        $results = $this->cache->get(__CLASS__ . $this->fieldType->getColumnName());

        foreach ($results as $result) {

            $result = (array) $result;

            $this->connection
                ->table($table->getTable())
                ->where($translatable ? 'entry_id' : 'id', array_pull($result, $translatable ? 'id' : 'entry_id'))
                ->update($result);
        }

        $this->cache->forget(__CLASS__ . $this->fieldType->getColumnName());
    }
}
