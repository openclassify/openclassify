<?php namespace Anomaly\Streams\Platform\Ui\Entity\Event;

use Anomaly\Streams\Platform\Ui\Entity\Entity;

/**
 * Class EntityWasBuilt
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Event
 */
class EntityWasBuilt
{

    /**
     * The entity object.
     *
     * @var Entity
     */
    protected $entity;

    /**
     * Create a EntityWasBuilt instance.
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the entity.
     *
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
