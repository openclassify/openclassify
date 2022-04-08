<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\GridAuthorizer;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class AuthorizeGrid
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizeGrid
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new AuthorizeGrid instance.
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
     * @param GridAuthorizer $authorizer
     */
    public function handle(GridAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}
