<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field\Command;

use Anomaly\Streams\Platform\Ui\Entity\Component\Field\FieldBuilder;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class BuildFields
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field\Command
 */
class BuildFields
{

    /**
     * The table builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFields instance.
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
     * @param FieldBuilder $builder
     */
    public function handle(FieldBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
