<?php namespace Visiosoft\LocationModule;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Category\CategorySeeder;
use Visiosoft\LocationModule\City\CitySeeder;
use Visiosoft\LocationModule\Country\CountrySeeder;
use Visiosoft\LocationModule\District\DistrictSeeder;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodSeeder;
use Visiosoft\LocationModule\Village\VillageSeeder;

class LocationModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        //Download demo SQL
        $repository = "https://raw.githubusercontent.com/openclassify/Openclassify-Demo-Data/master/";
        file_put_contents(__DIR__."/countries.sql", fopen($repository."countries.sql", 'r'));
        file_put_contents(__DIR__."/cities.sql", fopen($repository."cities.sql", 'r'));
        file_put_contents(__DIR__."/districts.sql", fopen($repository."districts.sql", 'r'));
        file_put_contents(__DIR__."/neighborhoods.sql", fopen($repository."neighborhoods.sql", 'r'));

        /* Demo Start */
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/countries.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/cities.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/districts.sql'));
         DB::unprepared(file_get_contents(__DIR__.'/neighborhoods.sql'));
        Model::reguard();
        /* Demo Stop*/
    }
}