<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\FilterBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class BuildFilters
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildFilters
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFilters instance.
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
     * @param FilterBuilder $builder
     */
    public function handle(FilterBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
