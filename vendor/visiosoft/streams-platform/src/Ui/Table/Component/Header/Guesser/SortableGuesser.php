<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header\Guesser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class SortableGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SortableGuesser
{

    /**
     * Guess the sortable flags for headers.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $columns = $builder->getColumns();
        $stream  = $builder->getTableStream();

        foreach ($columns as &$column) {
            if ($builder->getTableOption('sortable_headers') === false) {
                $column['sortable'] = false;

                continue;
            }

            /*
             * If the heading is false or does not exist
             * then the intent was to not have
             * heading text at all.
             */
            if (!isset($column['heading']) || $column['heading'] === false) {
                continue;
            }

            /*
             * If sortable is already set the we don't
             * need to guess anything.
             */
            if (isset($column['sortable'])) {
                continue;
            }

            /*
             * If the sort column is set and
             * sortable is not yet, set it.
             */
            if (isset($column['sort_column'])) {
                $column['sortable'] = true;

                continue;
            }

            /*
             * No stream means we can't
             * really do much here.
             */
            if (!$stream instanceof StreamInterface) {
                continue;
            }

            /*
             * We're going to be using the value to
             * try and determine if a streams field is
             * being used. No value, no guess.
             */
            if (!isset($column['value']) || !$column['value'] || !is_string($column['value'])) {
                continue;
            }

            /*
             * Now we're going to try and determine
             * what streams field this column if
             * using if any at all.
             */
            $field = $column['value'];

            /*
             * If the value matches a field
             * with dot format then reduce it.
             */
            if (preg_match("/^entry.([a-zA-Z\\_]+)/", $column['value'], $match)) {
                $field = $match[1];
            }

            /*
             * If we can't determine a field type
             * then we don't have anything to base
             * our guess off of.
             */
            if (!$assignment = $stream->getAssignment($field)) {
                continue;
            }

            $type = $assignment->getFieldType();

            /*
             * If the field type has a database
             * column type then we can sort on it
             * by default!
             *
             * @todo: Allow sorting of translatable fields.
             */
            if ($type->getColumnType() && !$assignment->isTranslatable()) {
                $column['sortable']    = true;
                $column['sort_column'] = $type->getColumnName();
            } else {
                $column['sortable'] = false;
            }
        }

        $builder->setColumns($columns);
    }
}
