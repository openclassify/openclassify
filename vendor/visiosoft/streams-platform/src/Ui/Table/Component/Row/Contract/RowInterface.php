<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Row\Contract;

use Illuminate\Support\Collection;

/**
 * Interface RowInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface RowInterface
{

    /**
     * Get the class.
     *
     * @return null
     */
    public function getClass();

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class);

    /**
     * Set the row buttons.
     *
     * @param $buttons
     * @return $this
     */
    public function setButtons($buttons);

    /**
     * Get the row buttons.
     *
     * @return mixed
     */
    public function getButtons();

    /**
     * Set the row columns.
     *
     * @param $columns
     * @return $this
     */
    public function setColumns(Collection $columns);

    /**
     * Get the row columns.
     *
     * @return mixed
     */
    public function getColumns();

    /**
     * Set the row entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry);

    /**
     * Get the row entry.
     *
     * @return mixed
     */
    public function getEntry();
}
