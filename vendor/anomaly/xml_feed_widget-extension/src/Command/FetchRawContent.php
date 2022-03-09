<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;

/**
 * Class FetchRawContent
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FetchRawContent
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new FetchRawContent instance.
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

        $options = [
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
        ];

        // Hard-code this for now.
        $rss->set_raw_data(
            file_get_contents(
                $configuration->value(
                    'anomaly.extension.xml_feed_widget::url',
                    $this->widget->getId(),
                    'http://pyrocms.com/posts/rss.xml'
                ),
                false,
                stream_context_create($options)
            )
        );

        // Make the request.
        $rss->init();

        return $rss->get_items(0, 5);
    }
}
