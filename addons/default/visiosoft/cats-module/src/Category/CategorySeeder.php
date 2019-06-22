<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        DB::table('cats_category')->truncate();
        DB::table('cats_category_translations')->truncate();
    }
}
