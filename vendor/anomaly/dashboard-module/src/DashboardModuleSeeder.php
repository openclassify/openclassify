<?php namespace Anomaly\DashboardModule;

use Anomaly\DashboardModule\Dashboard\DashboardSeeder;
use Anomaly\DashboardModule\Widget\WidgetSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class DashboardModuleSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(DashboardSeeder::class);
        $this->call(WidgetSeeder::class);
    }
}
