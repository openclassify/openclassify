<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Model\EloquentQueryBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FieldTypeQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeQuery
{

    /**
     * The where constraint to use.
     *
     * @var string
     */
    protected $constraint = 'and';

    /**
     * The parent field type.
     *
     * @var FieldType
     */
    protected $fieldType;

    /**
     * Create a new FieldTypeQuery instance.
     *
     * @param FieldType $fieldType
     */
    public function __construct(FieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Filter a query by the value of a
     * field using this field type.
     *
     * @param Builder         $query
     * @param FilterInterface $filter
     */
    public function filter(Builder $query, FilterInterface $filter)
    {
        $stream       = $filter->getStream();
        $entry        = $stream->getEntryTableName();
        $column       = $this->fieldType->getColumnName();
        $assignment   = $stream->getAssignment($filter->getField());
        $translations = $stream->getEntryTranslationsTableName();

        if ($assignment->isTranslatable()) {

            if ($query instanceof EloquentQueryBuilder && !$query->hasJoin($translations)) {

                $query->leftJoin(
                    $translations,
                    "{$entry}.id",
                    '=',
                    "{$translations}.entry_id"
                );
            }

            $query->addSelect("{$translations}.locale");
            $query->addSelect("{$translations}.{$column}");

            $query->{$this->where()}(
                function (Builder $query) use ($translations, $filter, $column) {

                    /**
                     *  closed this block because it breaks 'multiple field type'.
                     */

//                    $query->where(
//                        "{$translations}.locale",
//                        config('app.locale')
//                    );

                    if (method_exists($this->fieldType, 'getRelation')) {
                        $query->where(
                            "{$translations}.{$column}",
                            $filter->getValue()
                        );
                    } else {
                        $query->where(
                            "{$translations}.{$column}",
                            'LIKE',
                            "%{$filter->getValue()}%"
                        );
                    }
                }
            );
        } else {
            $query->{$this->where()}(
                function (Builder $query) use ($stream, $filter, $column, $entry) {

                    if (method_exists($this->fieldType, 'getRelation')) {

                        $query->where(
                            "{$entry}.{$column}",
                            $filter->getValue()
                        );
                    } else {

                        $query->where(
                            "{$entry}.{$column}",
                            'LIKE',
                            "%{$filter->getValue()}%"
                        );
                    }
                }
            );
        }
    }

    /**
     * Return the where clause for the given constraint.
     *
     * @return string
     */
    protected function where()
    {
        return $this->constraint == 'and' ? 'where' : 'orWhere';
    }

    /**
     * Order a query in the given direction
     * by a field using this field type.
     *
     * @param Builder $query
     * @param         $direction
     */
    public function orderBy(Builder $query, $direction)
    {
        $query->orderBy($this->fieldType->getColumnName(), $direction);
    }

    /**
     * Get the constraint.
     *
     * @return string
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * Set the constraint.
     *
     * @param $constraint
     * @return $this
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;

        return $this;
    }
}
