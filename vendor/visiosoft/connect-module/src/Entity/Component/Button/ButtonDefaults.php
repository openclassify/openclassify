<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonDefaults
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button
 */
class ButtonDefaults
{

    /**
     * Default the entity buttons when none are defined.
     *
     * @param EntityBuilder $builder
     */
    public function defaults(EntityBuilder $builder)
    {
        if ($builder->getButtons() === []) {
            $builder->setButtons(['cancel']);
        }
    }
}
