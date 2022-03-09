<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SetActiveAction
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command
 */
class SetActiveAction
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntityFiltersCommand instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the entity builder.
     *
     * @return EntityBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
