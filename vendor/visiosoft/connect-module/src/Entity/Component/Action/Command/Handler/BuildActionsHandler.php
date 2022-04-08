<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\Handler;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\ActionBuilder;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\BuildActions;

/**
 * Class BuildActionsHandler
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Listener\Command
 */
class BuildActionsHandler
{

    /**
     * The action builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Entity\Component\Action\ActionBuilder
     */
    protected $builder;

    /**
     * Create a new BuildActionsHandler instance.
     *
     * @param ActionBuilder $builder
     */
    public function __construct(ActionBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build actions and load them to the entity.
     *
     * @param BuildActions $command
     */
    public function handle(BuildActions $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
