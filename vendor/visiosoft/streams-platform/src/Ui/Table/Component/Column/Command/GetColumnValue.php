<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract\ColumnInterface;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class GetColumnValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetColumnValue
{

    /**
     * The table object.
     *
     * @var \Anomaly\Streams\Platform\Ui\Table\Table
     */
    protected $table;

    /**
     * The column object.
     *
     * @var \Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract\ColumnInterface
     */
    protected $column;

    /**
     * The entry object.
     *
     * @var mixed
     */
    protected $entry;

    /**
     * Create a new GetColumnValue instance.
     *
     * @param Table           $table
     * @param ColumnInterface $column
     * @param                 $entry
     */
    public function __construct(Table $table, ColumnInterface $column, $entry)
    {
        $this->entry  = $entry;
        $this->table  = $table;
        $this->column = $column;
    }

    /**
     * Get the column object.
     *
     * @return ColumnInterface
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Get the table object.
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Get the entry object.
     *
     * @return mixed
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
