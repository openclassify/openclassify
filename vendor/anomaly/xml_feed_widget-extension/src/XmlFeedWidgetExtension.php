<?php namespace Anomaly\XmlFeedWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\XmlFeedWidgetExtension\Command\LoadItems;

/**
 * Class XmlFeedWidgetExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class XmlFeedWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides the "Recent News"
     * widget for the main dashboard.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.dashboard::widget.xml_feed';

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        $this->dispatch(new LoadItems($widget));
    }
}
