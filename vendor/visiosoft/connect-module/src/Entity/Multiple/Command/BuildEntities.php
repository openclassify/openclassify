<?php namespace Anomaly\Streams\Platform\Ui\Entity\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\MultipleEntityBuilder;


/**
 * Class BuildEntities
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Multiple\Command
 */
class BuildEntities
{

    /**
     * The multiple entity builder.
     *
     * @var MultipleEntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntities instance.
     *
     * @param MultipleEntityBuilder $builder
     */
    public function __construct(MultipleEntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var EntityBuilder $builder */
        foreach ($this->builder->getEntities() as $builder) {
            $builder->build();
        }
    }
}
