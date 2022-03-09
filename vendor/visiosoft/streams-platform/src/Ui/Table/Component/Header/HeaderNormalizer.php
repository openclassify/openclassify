<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeaderNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HeaderNormalizer
{

    /**
     * Normalize header input.
     *
     * @param TableBuilder $builder
     */
    public function normalize(TableBuilder $builder)
    {
        $columns = $builder->getColumns();

        foreach ($columns as $key => &$column) {

            /*
             * If the key is non-numerical then
             * use it as the header and use the
             * column as the column if it's a class.
             */
            if (!is_numeric($key) && !is_array($column) && class_exists($column)) {
                $column = [
                    'heading' => $key,
                    'column'  => $column,
                ];
            }

            /*
             * If the key is non-numerical then
             * use it as the header and use the
             * column as the value.
             */
            if (!is_numeric($key) && !is_array($column) && !class_exists($column)) {
                $column = [
                    'value' => $column,
                    'field' => $key,
                ];
            }

            /*
             * If the column is just a string then treat
             * it as the header AND the value.
             */
            if (is_string($column)) {
                $column = [
                    'field' => $column,
                    'value' => $column,
                ];
            }

            /*
             * If the key is non-numerical and
             * the column is an array without
             * a heading then use the key.
             */
            if (!is_numeric($key) && is_array($column) && !isset($column['field'])) {
                $column['field'] = $key;
            }

            /*
             * If the key is non-numerical and
             * the column is an array without
             * a value then use the key.
             */
            if (!is_numeric($key) && is_array($column) && !isset($column['value'])) {
                $column['value'] = $key;
            }

            /*
             * If there is no value then use NULL
             */
            array_set($column, 'value', array_get($column, 'value', null));
        }

        $builder->setColumns($columns);
    }
}
