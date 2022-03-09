<?php namespace Anomaly\DashboardModule\Widget\Extension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Contracts\View\Factory;

/**
 * Class SetContent
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetContent
{

    /**
     * The widget extension.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new SetContent instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the output.
     *
     * @param  Factory                         $view
     * @return \Illuminate\Contracts\View\View
     */
    public function handle(Factory $view)
    {
        $extension = $this->widget->getExtension();

        $this->widget->setContent($view->make($extension->getView(), ['widget' => $this->widget]));
    }
}
