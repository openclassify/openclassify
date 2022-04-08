<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\Column\ColumnBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Command\BuildColumns;

/**
 * Class BuildColumnsHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildColumnsHandler
{

    /**
     * The column builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Table\Component\Column\ColumnBuilder
     */
    protected $builder;

    /**
     * Create a new BuildColumnsHandler instance.
     *
     * @param ColumnBuilder $builder
     */
    public function __construct(ColumnBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build columns and load them to the table.
     *
     * @param BuildColumns $command
     */
    public function handle(BuildColumns $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
