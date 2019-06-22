<?php namespace Visiosoft\AdvsModule;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
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
        $this->call(AdvSeeder::class);

        /* Demo Start */
        DB::table('files_files')->truncate();
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/demo.sql'));
        Model::reguard();
        /* Demo Stop*/
    }
}