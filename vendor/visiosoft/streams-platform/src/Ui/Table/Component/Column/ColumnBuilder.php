<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ColumnBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ColumnBuilder
{

    /**
     * The column reader.
     *
     * @var ColumnInput
     */
    protected $input;

    /**
     * The column value.
     *
     * @var ColumnValue
     */
    protected $value;

    /**
     * The column factory.
     *
     * @var ColumnFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ColumnBuilder instance.
     *
     * @param ColumnInput   $input
     * @param ColumnValue   $value
     * @param ColumnFactory $factory
     * @param Evaluator     $evaluator
     */
    public function __construct(ColumnInput $input, ColumnValue $value, ColumnFactory $factory, Evaluator $evaluator)
    {
        $this->input     = $input;
        $this->value     = $value;
        $this->factory   = $factory;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the columns.
     *
     * @param  TableBuilder     $builder
     * @param                   $entry
     * @return ColumnCollection
     */
    public function build(TableBuilder $builder, $entry)
    {
        $table = $builder->getTable();

        $columns = new ColumnCollection();

        $this->input->read($builder);

        foreach ($builder->getColumns() as $column) {
            array_set($column, 'entry', $entry);

            $column = $this->evaluator->evaluate($column, compact('entry', 'table'));

            $column['value'] = $this->value->make($table, $column, $entry);

            $columns->push($this->factory->make($column));
        }

        return $columns;
    }
}
