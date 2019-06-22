<?php namespace Visiosoft\CatsModule;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Visiosoft\CatsModule\Category\CategorySeeder;
use Visiosoft\CatsModule\Placeholderforsearch\PlaceholderforsearchSeeder;

class CatsModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(PlaceholderforsearchSeeder::class);
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/Category/categories.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/Category/categoryTransEn.sql'));
        Model::reguard();
    }
}