<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\ArgvInput;

class LocationModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        //Download demo SQL
        $application_reference = (new ArgvInput())->getParameterOption('--app', env('APPLICATION_REFERENCE', 'default'));
        $countries = str_replace('{application_reference}', $application_reference, file_get_contents(realpath(dirname(__DIR__)) . '/src/Seed/Data/countries.sql'));
        $cities = str_replace('{application_reference}', $application_reference, file_get_contents(realpath(dirname(__DIR__)) . '/src/Seed/Data/cities.sql'));
        $districts = str_replace('{application_reference}', $application_reference, file_get_contents(realpath(dirname(__DIR__)) . '/src/Seed/Data/districs.sql'));
        $neighborhoods = str_replace('{application_reference}', $application_reference, file_get_contents(realpath(dirname(__DIR__)) . '/src/Seed/Data/neighborhoods.sql'));
        Model::unguard();
        DB::unprepared($countries);
        DB::unprepared($cities);
        DB::unprepared($districts);
        DB::unprepared($neighborhoods);
        Model::reguard();

        $this->command->call('files:sync');
        Artisan::call('assets:clear');
    }
}
