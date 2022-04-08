<?php namespace Anomaly\Streams\Platform\Ui\Table\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Table\Multiple\MultipleTableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class MergeRows
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MergeRows
{

    /**
     * The multiple form builder.
     *
     * @var MultipleTableBuilder
     */
    protected $builder;

    /**
     * Create a new MergeRows instance.
     *
     * @param MultipleTableBuilder $builder
     */
    public function __construct(MultipleTableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var TableBuilder $builder */
        foreach ($this->builder->getTables() as $builder) {
            $this->mergeFields($this->builder->getTable(), $builder->getTable());
        }
    }

    /**
     * Merge rows into the form.
     *
     * @param Table $parent
     * @param Table $child
     */
    protected function mergeFields(Table $parent, Table $child)
    {
        foreach ($child->getRows() as $row) {
            $parent->addRow($row);
        }
    }
}
