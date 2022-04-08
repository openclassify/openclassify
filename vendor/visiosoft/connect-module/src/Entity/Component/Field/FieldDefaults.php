<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldDefaults
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldDefaults
{

    /**
     * Default the entity fields when none are defined.
     *
     * @param EntityBuilder $builder
     */
    public function defaults(EntityBuilder $builder)
    {
        if ($builder->getFields() === []) {
            $builder->setFields(['*']);
        }
    }
}
