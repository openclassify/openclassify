<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\Handler;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\SetActiveAction;

/**
 * Class SetActiveActionHandler
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command
 */
class SetActiveActionHandler
{

    /**
     * Set the active action.
     *
     * @param SetActiveAction $command
     */
    public function handle(SetActiveAction $command)
    {
        $builder = $command->getBuilder();
        $entity  = $builder->getEntity();
        $options = $entity->getOptions();
        $actions = $entity->getActions();

        if ($action = $actions->findBySlug(app('request')->get($options->get('prefix') . 'action'))) {
            $action->setActive(true);
        }

        if (!$action && $action = $actions->first()) {
            $action->setActive(true);
        }
    }
}
