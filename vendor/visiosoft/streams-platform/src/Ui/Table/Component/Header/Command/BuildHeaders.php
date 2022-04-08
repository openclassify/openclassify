<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header\Command;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\HeaderBuilder;

/**
 * Class BuildHeaders
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildHeaders
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildHeaders instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command
     *
     * @param HeaderBuilder $builder
     */
    public function handle(HeaderBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
