<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\Component\Action\Command\BuildActions;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Command\SetActiveAction;
use Anomaly\Streams\Platform\Ui\Form\Component\Button\Command\BuildButtons;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\Command\BuildFields;
use Anomaly\Streams\Platform\Ui\Form\Component\Section\Command\BuildSections;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasBuilt;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildForm
{

    use DispatchesJobs;

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormColumnsCommand instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {

        /*
         * Setup some objects and options using
         * provided input or sensible defaults.
         */
        $this->dispatchNow(new AddAssets($this->builder));
        $this->dispatchNow(new SetFormModel($this->builder));
        $this->dispatchNow(new SetFormStream($this->builder));
        $this->dispatchNow(new SetRepository($this->builder));
        $this->dispatchNow(new SetFormEntry($this->builder));
        $this->dispatchNow(new SetFormVersion($this->builder));
        $this->dispatchNow(new SetDefaultParameters($this->builder));
        $this->dispatchNow(new SetFormOptions($this->builder));
        $this->dispatchNow(new SetDefaultOptions($this->builder));

        /*
         * Load anything we need that might be flashed.
         */
        $this->dispatchNow(new LoadFormErrors($this->builder));

        /*
         * Before we go any further, authorize the request.
         */
        $this->dispatchNow(new AuthorizeForm($this->builder));

        /*
         * Lock form model.
         */
        $this->dispatchNow(new LockFormModel($this->builder));

        /*
         * Build form fields.
         */
        $this->dispatchNow(new BuildFields($this->builder));

        /*
         * Build form sections.
         */
        $this->dispatchNow(new BuildSections($this->builder));

        /*
         * Build form actions and flag active.
         */
        $this->dispatchNow(new BuildActions($this->builder));
        $this->dispatchNow(new SetActiveAction($this->builder));

        /*
         * Build form buttons.
         */
        $this->dispatchNow(new BuildButtons($this->builder));

        event(new FormWasBuilt($this->builder));
    }
}
