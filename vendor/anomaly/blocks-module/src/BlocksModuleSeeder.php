<?php namespace Anomaly\BlocksModule;

use Anomaly\BlocksModule\Area\AreaSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class BlocksModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(AreaSeeder::class);
    }

}
