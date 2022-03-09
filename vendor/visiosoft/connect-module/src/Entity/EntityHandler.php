<?php namespace Anomaly\Streams\Platform\Ui\Entity;


/**
 * Class EntityHandler
 *

 * @package Anomaly\Streams\Platform\Ui\Entity
 */
class EntityHandler
{

    /**
     * Handle the entity.
     *
     * @param EntityBuilder $builder
     */
    public function handle(EntityBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveEntity();
    }
}
