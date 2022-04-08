<?php namespace Anomaly\Streams\Platform\Ui\Entity\Contract;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Interface EntityRepositoryInterface
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Contract
 */
interface EntityRepositoryInterface
{

    /**
     * Find an entry or return a new one.
     *
     * @param $id
     * @return mixed
     */
    public function findOrNew($id);

    /**
     * Save the entity.
     *
     * @param EntityBuilder $builder
     * @return bool|mixed
     */
    public function save(EntityBuilder $builder);
}
