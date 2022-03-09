<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Command;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Command\BuildButtons;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Command\BuildNavigation;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Command\SetActiveNavigationLink;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Command\SetMainNavigationLinks;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Command\BuildSections;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Command\SetActiveSection;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Command\BuildShortcuts;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\Event\ControlPanelIsBuilding;
use Anomaly\Streams\Platform\Ui\ControlPanel\Event\ControlPanelWasBuilt;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildControlPanel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildControlPanel
{

    use DispatchesJobs;

    /**
     * The builder object.
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create a new BuildControlPanel instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle(Asset $asset)
    {
        event(new ControlPanelIsBuilding($this->builder));

        $asset->add('scripts.js', 'streams::js/cp/click.js');

        $this->dispatchNow(new BuildNavigation($this->builder));
        $this->dispatchNow(new SetActiveNavigationLink($this->builder));
        $this->dispatchNow(new SetMainNavigationLinks($this->builder));

        $this->dispatchNow(new BuildSections($this->builder));
        $this->dispatchNow(new SetActiveSection($this->builder));

        $this->dispatchNow(new BuildShortcuts($this->builder));

        $this->dispatchNow(new BuildButtons($this->builder));

        event(new ControlPanelWasBuilt($this->builder));
    }
}
