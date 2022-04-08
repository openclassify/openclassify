<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button\Command\Handler;

use Anomaly\Streams\Platform\Ui\Entity\Component\Button\ButtonBuilder;
use Anomaly\Streams\Platform\Ui\Entity\Component\Button\Command\BuildButtons;

/**
 * Class BuildButtonsHandler
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button\Listener\Command
 */
class BuildButtonsHandler
{

    /**
     * The button builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Entity\Component\Button\ButtonBuilder
     */
    protected $builder;

    /**
     * Create a new BuildButtonsHandler instance.
     *
     * @param ButtonBuilder $builder
     */
    public function __construct(ButtonBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build buttons and load them to the entity.
     *
     * @param BuildButtons $command
     */
    public function handle(BuildButtons $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
