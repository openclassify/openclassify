<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Row\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\Row\RowBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class BuildRows
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildRows
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildRows instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param RowBuilder $builder
     */
    public function handle(RowBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
