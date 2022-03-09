<?php namespace Anomaly\Streams\Platform\Ui\Entity\Event;

use Anomaly\Streams\Platform\Ui\Entity\Entity;

/**
 * Class EntityIsSaving
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Event
 */
class EntityIsSaving
{

    /**
     * The entity object.
     *
     * @var Entity
     */
    protected $entity;

    /**
     * Create a new EntityIsSaving instance.
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Ge the entity.
     *
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
