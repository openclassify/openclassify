<?php namespace Anomaly\DashboardModule\Widget\Extension\Contract;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

/**
 * Interface WidgetExtensionInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface WidgetExtensionInterface
{

    /**
     * Return the widget output.
     *
     * @param  WidgetInterface                 $widget
     * @return \Illuminate\Contracts\View\View
     */
    public function output(WidgetInterface $widget);

    /**
     * Get the view.
     *
     * @return string
     */
    public function getView();

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view);

    /**
     * Get the contextual state.
     *
     * @return string
     */
    public function getContext();

    /**
     * Set the contextual state.
     *
     * @param $context
     * @return $this
     */
    public function setContext($context);

    /**
     * Get the wrapper.
     *
     * @return string
     */
    public function getWrapper();

    /**
     * Set the wrapper.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper);
}
