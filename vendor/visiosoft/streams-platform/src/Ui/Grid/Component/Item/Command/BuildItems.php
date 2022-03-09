<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Item\Command;

use Anomaly\Streams\Platform\Ui\Grid\Component\Item\ItemBuilder;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class BuildItems
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildItems
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new BuildItems instance.
     *
     * @param GridBuilder $builder
     */
    public function __construct(GridBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ItemBuilder $builder
     */
    public function handle(ItemBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
