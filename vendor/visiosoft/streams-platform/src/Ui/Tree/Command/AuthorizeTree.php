<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeAuthorizer;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class AuthorizeTree
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizeTree
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new AuthorizeTree instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param TreeAuthorizer $authorizer
     */
    public function handle(TreeAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}
