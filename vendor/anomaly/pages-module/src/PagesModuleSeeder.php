<?php namespace Anomaly\PagesModule;

use Anomaly\PagesModule\Page\PageSeeder;
use Anomaly\PagesModule\Type\TypeSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class PagesModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(PageSeeder::class);
    }
}
