<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Support\Value;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\View\View;

/**
 * Class ColumnValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ColumnValue
{

    /**
     * The value resolver.
     *
     * @var Value
     */
    protected $value;

    /**
     * Create a new ColumnValue instance.
     *
     * @param Value $value
     */
    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    /**
     * Return the column value.
     *
     * @param  Table           $table
     * @param  array           $column
     * @param                  $entry
     * @return View|mixed|null
     */
    public function make(Table $table, $column, $entry)
    {
        if (is_array($column['value'])) {
            foreach ($column['value'] as &$value) {
                $value = $this->value->make($value, $entry, 'entry', compact('table'));
            }
        }

        return $this->value->make($column, $entry, 'entry', compact('table'));
    }
}
