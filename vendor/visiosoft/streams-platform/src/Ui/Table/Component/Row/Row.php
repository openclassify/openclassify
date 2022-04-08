<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Row;

use Anomaly\Streams\Platform\Ui\Button\ButtonCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Row\Contract\RowInterface;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Support\Collection;

/**
 * Class Row
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Row implements RowInterface
{

    /**
     * The row key.
     *
     * @var null
     */
    protected $key = null;

    /**
     * The row class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The row entry.
     *
     * @var mixed
     */
    protected $entry = null;

    /**
     * The row table.
     *
     * @var null|Table
     */
    protected $table = null;

    /**
     * The row columns.
     *
     * @var Collection
     */
    protected $columns;

    /**
     * The row buttons.
     *
     * @var ButtonCollection
     */
    protected $buttons;

    /**
     * Get the key.
     *
     * @return null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the key.
     *
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the class.
     *
     * @return null
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Set the row buttons.
     *
     * @param $buttons
     * @return $this
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get the row buttons.
     *
     * @return mixed
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the row columns.
     *
     * @param  Collection $columns
     * @return $this
     */
    public function setColumns(Collection $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the row columns.
     *
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Get the table.
     *
     * @return Table|null
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the table.
     *
     * @param  Table $table
     * @return $this
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Set the row entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the row entry.
     *
     * @return mixed
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
