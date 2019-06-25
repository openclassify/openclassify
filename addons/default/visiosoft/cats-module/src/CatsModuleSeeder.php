<?php namespace Visiosoft\CatsModule;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Chumper\Zipper\Zipper;
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

        //Download demo SQL
        $repository = "https://raw.githubusercontent.com/openclassify/Openclassify-Demo-Data/master/";
        file_put_contents(__DIR__."/categories.sql", fopen($repository."categories.sql", 'r'));
        file_put_contents(__DIR__."/categoryTransEn.sql", fopen($repository."categoryTransEn.sql", 'r'));
        //Download demo Files and Extract to Files
        file_put_contents("category-files.zip", fopen($repository."category-files.zip", 'r'));
        $zipper = new Zipper();
        $zipper->make('category-files.zip')->folder('category-files')->extractTo(base_path().'/public/app/default/files-module/local/images/');
        $zipper->close();

        $this->call(PlaceholderforsearchSeeder::class);
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/categories.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/categoryTransEn.sql'));
        Model::reguard();
    }
}