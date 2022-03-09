<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionDefaults
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionDefaults
{

    /**
     * Default the entity actions when none are defined.
     *
     * @param EntityBuilder $builder
     */
    public function defaults(EntityBuilder $builder)
    {
        if ($builder->getActions() === []) {
            $builder->setActions(['save', 'save_and_edit']);
        }
    }
}
