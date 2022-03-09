<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\ActionResponder;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetActionResponse
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetActionResponse
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetActionResponse instance.
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
     * @param ActionResponder $responder
     */
    public function handle(ActionResponder $responder)
    {
        $actions = $this->builder->getEntityActions();

        if ($this->builder->getEntityResponse()) {
            return;
        }

        if ($this->builder->hasEntityErrors()) {
            return;
        }

        if (!$this->builder->canSave()) {
            return;
        }

        if ($action = $actions->active()) {
            $responder->setEntityResponse($this->builder, $action);
        }
    }
}
