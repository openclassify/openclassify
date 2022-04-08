<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class BuildButtons
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button\Command
 */
class BuildButtons
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildButtons instance.
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
