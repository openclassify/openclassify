<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityAuthorizer;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class AuthorizeEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class AuthorizeEntity
{

    /**
     * The table builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntityColumnsCommand instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param EntityAuthorizer $authorizer
     */
    public function handle(EntityAuthorizer $authorizer)
    {
        $authorizer->authorize($this->builder);
    }
}
