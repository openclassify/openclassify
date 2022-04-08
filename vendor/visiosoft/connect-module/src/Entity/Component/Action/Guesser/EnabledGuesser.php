<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class EnabledGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser
 */
class EnabledGuesser
{

    /**
     * Guess the action's enabled parameter.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $actions = $builder->getActions();

        $mode = $builder->getEntityMode();

        foreach ($actions as &$action) {

            if (isset($action['enabled']) && is_bool($action['enabled'])) {
                return;
            }

            if (isset($action['enabled']) && is_string($action['enabled'])) {
                $action['enabled'] = $mode === $action['enabled'];
            }
        }

        $builder->setActions($actions);
    }
}
