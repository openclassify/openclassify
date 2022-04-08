<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Row;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Table\Component\Button\ButtonBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\ColumnBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class RowBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class RowBuilder
{

    /**
     * The column builder.
     *
     * @var ColumnBuilder
     */
    protected $columns;

    /**
     * The button builder.
     *
     * @var ButtonBuilder
     */
    protected $buttons;

    /**
     * The row factory.
     *
     * @var RowFactory
     */
    protected $factory;

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new RowBuilder instance.
     *
     * @param RowFactory    $factory
     * @param ColumnBuilder $columns
     * @param ButtonBuilder $buttons
     * @param Evaluator     $evaluator
     */
    public function __construct(
        RowFactory $factory,
        ColumnBuilder $columns,
        ButtonBuilder $buttons,
        Evaluator $evaluator
    ) {
        $this->factory   = $factory;
        $this->columns   = $columns;
        $this->buttons   = $buttons;
        $this->evaluator = $evaluator;
    }

    /**
     * Build the rows.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        foreach ($builder->getTableEntries() as $entry) {

            $columns = $this->columns->build($builder, $entry);
            $buttons = $this->buttons->build($builder, $entry);

            $buttons = $buttons->enabled();

            $class = $builder->getOption('row_class');

            $row = compact('columns', 'buttons', 'entry', 'class');

            $row['key'] = data_get(
                $entry,
                $builder->getOption('row_key', 'id')
            );

            $row['table'] = $builder->getTable();

            $row = $this->evaluator->evaluate($row, compact('builder', 'entry'));

            $builder->addTableRow($this->factory->make($row));
        }
    }
}
