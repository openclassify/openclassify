<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Illuminate\Support\Collection;

/**
 * Class EntityCollection
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityCollection extends Collection
{

    /**
     * Put a entity into the entity collection.
     *
     * @param               $slug
     * @param EntityBuilder $entity
     * @return $this
     */
    public function add($slug, EntityBuilder $entity)
    {
        $this->put($slug, $entity);

        return $this;
    }
}
