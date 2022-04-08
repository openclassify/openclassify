<?php namespace Anomaly\DashboardModule\Widget;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class WidgetSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetSeeder extends Seeder
{

    /**
     * The widget repository.
     *
     * @var WidgetRepositoryInterface
     */
    protected $widgets;

    /**
     * The dashboard repository.
     *
     * @var DashboardRepositoryInterface
     */
    protected $dashboards;

    /**
     * The configuration repository.
     *
     * @var ConfigurationRepositoryInterface
     */
    protected $configuration;

    /**
     * Create a new WidgetSeeder instance.
     *
     * @param WidgetRepositoryInterface        $widgets
     * @param DashboardRepositoryInterface     $dashboards
     * @param ConfigurationRepositoryInterface $configuration
     */
    public function __construct(
        WidgetRepositoryInterface $widgets,
        DashboardRepositoryInterface $dashboards,
        ConfigurationRepositoryInterface $configuration
    ) {
        $this->widgets       = $widgets;
        $this->dashboards    = $dashboards;
        $this->configuration = $configuration;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->widgets->truncate();

        $dashboard = $this->dashboards->findBySlug('welcome');

        $widget = $this->widgets
            ->create(
                [
                    'en'        => [
                        'title'       => 'Recent News',
                        'description' => 'Recent news from https://pyrocms.com/',
                    ],
                    'extension' => 'anomaly.extension.xml_feed_widget',
                    'dashboard' => $dashboard,
                ]
            );

        $this->configuration->purge('anomaly.extension.xml_feed_widget');

        $this->configuration->create(
            [
                'scope' => $widget->getId(),
                'key'   => 'anomaly.extension.xml_feed_widget::url',
                'value' => 'http://www.pyrocms.com/posts/rss.xml',
            ]
        );


        $widget = $this->widgets
            ->create(
                [
                    'en'        => [
                        'title'       => 'Stack Overflow',
                        'description' => 'Recent questions from https://stackoverflow.com/',
                    ],
                    'extension' => 'anomaly.extension.xml_feed_widget',
                    'dashboard' => $dashboard,
                ]
            );

        $this->configuration->create(
            [
                'scope' => $widget->getId(),
                'key'   => 'anomaly.extension.xml_feed_widget::url',
                'value' => 'https://stackoverflow.com/feeds/tag?tagnames=PyroCMS&sort=newest',
            ]
        );
    }
}
