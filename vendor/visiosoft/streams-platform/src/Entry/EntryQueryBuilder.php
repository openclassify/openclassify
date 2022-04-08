<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Model\EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class EntryQueryBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryQueryBuilder extends EloquentQueryBuilder
{

    /**
     * The query model.
     *
     * @var EntryModel
     */
    protected $model;

    /**
     * Check for join automation.
     *
     * @param string $table
     * @param \Closure|string $first
     * @param null $operator
     * @param null $second
     * @param string $type
     * @param bool $where
     * @return $this
     */
    public function join($table, $first = null, $operator = null, $second = null, $type = 'inner', $where = false)
    {
        if ($this->model->hasField($table)) {

            /* @var Relation $relation */
            $relation = $this->model
                ->getFieldType($table)
                ->getRelation();

            $operator = $operator ?: '=';
            $table    = $relation->getModel()->getTable();
            $first    = $this->model->getTableName() . '.id';
            $second   = $second ?: $this->model->getTableName() . '.id';

            $this->query->addSelect(
                [$this->model->getTableName() . '.*'] +
                array_map(
                    function ($column) use ($table) {
                        return $table . '.' . $column;
                    },
                    array_diff(
                        $this->getConnection()->getSchemaBuilder()->getColumnListing($table),
                        [
                            'entry_id',
                            'created_at',
                            'created_by_id',
                            'updated_at',
                            'updated_by_id',
                            'deleted_at',
                            'deleted_by_id',
                            'sort_order',
                        ]
                    )
                )
            );

            $this->query->groupBy([$this->model->getTableName() . '.id', $table . '.id']);
        }

        return parent::join($table, $first, $operator, $second, $type, $where);
    }

    /**
     * Get a field type criteria.
     *
     * @param $field
     * @return FieldTypeQuery
     */
    public function getFieldTypeCriteria($field)
    {
        return $this->model
            ->getFieldType($field)
            ->getCriteria($this);
    }
}
