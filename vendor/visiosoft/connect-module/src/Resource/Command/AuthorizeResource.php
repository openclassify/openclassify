<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceAuthorizer;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;


/**
 * Class AuthorizeResource
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class AuthorizeResource
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResourceFormattersCommand instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResourceAuthorizer $authorizer
     */
    public function handle(ResourceAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}
