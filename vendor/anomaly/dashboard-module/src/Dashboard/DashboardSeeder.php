<?php namespace Anomaly\DashboardModule\Dashboard;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class DashboardSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardSeeder extends Seeder
{

    /**
     * The dashboard repository.
     *
     * @var DashboardRepositoryInterface
     */
    protected $dashboards;

    /**
     * Create a new DashboardSeeder instance.
     *
     * @param $dashboards
     */
    public function __construct(DashboardRepositoryInterface $dashboards)
    {
        $this->dashboards = $dashboards;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->dashboards
            ->truncate()
            ->create(
                [
                    'en'     => [
                        'name'        => 'Welcome',
                        'description' => 'This is the default dashboard for PyroCMS.',
                    ],
                    'slug'   => 'welcome',
                    'layout' => '24',
                ]
            );
    }
}
