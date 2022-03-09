<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Contract;

use Anomaly\Streams\Platform\Ui\Entity\Entity;

/**
 * Interface ActionHandlerInterface
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Contract
 */
interface ActionHandlerInterface
{

    /**
     * Handle the entity response.
     *
     * @param Entity $entity
     */
    public function handle(Entity $entity);
}
