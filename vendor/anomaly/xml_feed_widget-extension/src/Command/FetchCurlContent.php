<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

/**
 * Class FetchCurlContent
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FetchCurlContent
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new FetchCurlContent instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the command.
     *
     * @param \SimplePie                       $rss
     * @param ConfigurationRepositoryInterface $configuration
     * @return null|\SimplePie_Item[]
     */
    public function handle(\SimplePie $rss, ConfigurationRepositoryInterface $configuration)
    {
        // Let Laravel cache everything.
        $rss->enable_cache(false);

        // Hard-code this for now.
        $rss->set_feed_url(
            $configuration->value(
                'anomaly.extension.xml_feed_widget::url',
                $this->widget->getId(),
                'http://pyrocms.com/posts/rss.xml'
            )
        );

        // Make the request.
        $rss->init();

        return $rss->get_items(0, 5);
    }
}
