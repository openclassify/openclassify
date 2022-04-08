<?php namespace Anomaly\DashboardModule\Widget\Extension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\Command\GetOutput;
use Anomaly\DashboardModule\Widget\Extension\Command\SetContent;
use Anomaly\DashboardModule\Widget\Extension\Contract\WidgetExtensionInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class WidgetExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetExtension extends Extension implements WidgetExtensionInterface
{

    /**
     * The widget view.
     *
     * @var string
     */
    protected $view = null;

    /**
     * The contextual state.
     *
     * @var string
     */
    protected $context = 'primary';

    /**
     * The widget wrapper.
     *
     * @var string
     */
    protected $wrapper = 'anomaly.module.dashboard::admin/widgets/widget';

    /**
     * Return the widget output.
     *
     * @param  WidgetInterface                 $widget
     * @return \Illuminate\Contracts\View\View
     */
    public function output(WidgetInterface $widget)
    {
        $this->load($widget);
        $this->content($widget);

        return $this->dispatch(new GetOutput($widget));
    }

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        //
    }

    /**
     * Set the widget content.
     *
     * @param WidgetInterface $widget
     */
    protected function content(WidgetInterface $widget)
    {
        $this->dispatch(new SetContent($widget));
    }

    /**
     * Get the view.
     *
     * @return string
     */
    public function getView()
    {
        return $this->view ?: $this->getNamespace('content');
    }

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the wrapper.
     *
     * @return string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Set the wrapper.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get the contextual state.
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set the contextual state.
     *
     * @param $context
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }
}
