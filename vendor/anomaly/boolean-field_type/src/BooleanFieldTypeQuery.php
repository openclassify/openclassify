<?php namespace Anomaly\BooleanFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BooleanFieldTypeQuery
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class BooleanFieldTypeQuery extends FieldTypeQuery
{

    /**
     * Filter a query by the value of a
     * field using this field type.
     *
     * @param Builder $query
     * @param FilterInterface $filter
     */
    public function filter(Builder $query, FilterInterface $filter)
    {
        $stream     = $filter->getStream();
        $assignment = $stream->getAssignment($filter->getField());

        $column = $this->fieldType->getColumnName();

        $table        = $stream->getEntryTableName();
        $translations = $stream->getEntryTranslationsTableName();

        $modifier = $this->fieldType->getModifier();

        if ($assignment->isTranslatable()) {
            $query
                ->join($translations, $translations . '.entry_id', '=', $table . '.id')
                ->where($translations . '.' . $column, $modifier->modify($filter->getValue()))
                ->where('locale', config('app.locale'));
        } else {
            $query->where($column, $modifier->modify($filter->getValue()));
        }
    }
}
