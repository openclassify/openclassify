<?php namespace Anomaly\XmlFeedWidgetExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadItems
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadItems
{

    use DispatchesJobs;

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadItems instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the widget data.
     *
     * @param \SimplePie                       $rss
     * @param Repository                       $cache
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function handle(\SimplePie $rss, Repository $cache, ConfigurationRepositoryInterface $configuration)
    {
        $items = $cache->remember(
            __METHOD__ . '_' . $this->widget->getId(),
            30,
            function () use ($rss, $configuration) {

                try {

                    /**
                     * This should work and is more SSL friendly
                     * with providers like CloudFlare but can
                     * be disabled by security in some cases.
                     */
                    return $this->dispatch(new FetchRawContent($this->widget));
                } catch (\Exception $e) {

                    try {

                        /**
                         * If security is disabling file_get_contents
                         * then this way should work fine unless
                         * there is an SSL / TLS issue.
                         */
                        return $this->dispatch(new FetchCurlContent($this->widget));
                    } catch (\Exception $e) {

                        /**
                         * If everything above fails then we have
                         * an issue. Return false to let us know.
                         */
                        return false;
                    }
                }
            }
        );

        // Load the items to the widget's view data.
        $this->widget->addData('items', $items);
    }
}
