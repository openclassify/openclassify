<?php namespace Anomaly\PostsModule;

use Anomaly\PostsModule\Category\CategorySeeder;
use Anomaly\PostsModule\Post\PostSeeder;
use Anomaly\PostsModule\Type\TypeSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class PostsModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostsModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
    }
}
