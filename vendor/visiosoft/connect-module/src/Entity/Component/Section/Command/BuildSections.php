<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Section\Command;

use Anomaly\Streams\Platform\Ui\Entity\Component\Section\SectionBuilder;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class BuildSections
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Section\Command
 */
class BuildSections
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildSections instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param SectionBuilder $builder
     */
    public function handle(SectionBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
