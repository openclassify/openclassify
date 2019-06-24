<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Chumper\Zipper\Zipper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\AdvSeeder;

class AdvsModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        //Download demo SQL
        file_put_contents(__DIR__."/demo.sql", fopen("http://ilandemo.vebze.com/demo.sql", 'r'));
        //Download demo Files and Extract to Files
        file_put_contents("advs-files.zip", fopen("http://ilandemo.vebze.com/advs-files.zip", 'r'));
        $zipper = new Zipper();
        $zipper->make('advs-files.zip')->folder('advs-files')->extractTo(base_path().'/public/app/default/files-module/local/images/');
        $zipper->close();

        $this->call(AdvSeeder::class);

        /* Demo Start */
        DB::table('files_files')->truncate();
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/demo.sql'));
        Model::reguard();
        /* Demo Stop*/
    }
}