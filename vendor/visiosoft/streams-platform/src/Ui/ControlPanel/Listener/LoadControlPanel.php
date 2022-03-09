<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Listener;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class LoadControlPanel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadControlPanel
{

    use DispatchesJobs;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * The view template.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * The control panel builder.
     *
     * @var ControlPanelBuilder
     */
    protected $controlPanel;

    /**
     * Create a new LoadControlPanel instance.
     *
     * @param ControlPanelBuilder $controlPanel
     * @param ViewTemplate        $template
     * @param ModuleCollection    $modules
     * @param Request             $request
     */
    public function __construct(
        ControlPanelBuilder $controlPanel,
        ViewTemplate $template,
        ModuleCollection $modules,
        Request $request
    ) {
        $this->controlPanel = $controlPanel;
        $this->template     = $template;
        $this->modules      = $modules;
        $this->request      = $request;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        if (in_array($this->request->path(), ['admin/logout'])) {
            return;
        }

        if ($this->request->segment(1) !== 'admin') {
            return;
        }

        if (!$this->template->has('cp')) {
            $this->template->put('cp', $this->controlPanel->build());
        }
    }
}
