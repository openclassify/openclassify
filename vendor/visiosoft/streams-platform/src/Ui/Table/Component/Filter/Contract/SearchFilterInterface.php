<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract;

/**
 * Interface SearchFilterInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface SearchFilterInterface extends FilterInterface
{

    /**
     * Get the fields.
     *
     * @return array
     */
    public function getFields();

    /**
     * Set the fields.
     *
     * @param  array $fields
     * @return $this
     */
    public function setFields(array $fields);

    /**
     * Get the columns.
     *
     * @return array
     */
    public function getColumns();

    /**
     * Set the columns.
     *
     * @param  array $columns
     * @return $this
     */
    public function setColumns(array $columns);
}
