<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\BuildActions;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Command\SetActiveAction;
use Anomaly\Streams\Platform\Ui\Entity\Component\Button\Command\BuildButtons;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\Command\BuildFields;
use Anomaly\Streams\Platform\Ui\Entity\Component\Section\Command\BuildSections;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class BuildEntity
{

    use DispatchesJobs;

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntityColumnsCommand instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /**
         * Setup some objects and options using
         * provided input or sensible defaults.
         */
        $this->dispatch(new SetEntityModel($this->builder));
        $this->dispatch(new SetEntityStream($this->builder));
        $this->dispatch(new SetDefaultParameters($this->builder));
        $this->dispatch(new SetRepository($this->builder));

        $this->dispatch(new SetEntityOptions($this->builder));
        $this->dispatch(new SetEntityEntry($this->builder)); // Do this last.

        /**
         * Before we go any further, authorize the request.
         */
        $this->dispatch(new AuthorizeEntity($this->builder));

        /*
         * Build entity fields.
         */
        $this->dispatch(new BuildFields($this->builder));

        /**
         * Build entity sections.
         */
        $this->dispatch(new BuildSections($this->builder));

        /**
         * Build entity actions and flag active.
         */
        $this->dispatch(new BuildActions($this->builder));
        $this->dispatch(new SetActiveAction($this->builder));

        /**
         * Build entity buttons.
         */
        $this->dispatch(new BuildButtons($this->builder));
    }
}
