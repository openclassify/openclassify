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
        file_put_contents(storage_path('countries.sql'), fopen($repository . "countries.sql", 'r'));
        file_put_contents(storage_path('cities.sql'), fopen($repository . "cities.sql", 'r'));

        /* Demo Start */
        Model::unguard();
        DB::unprepared(file_get_contents(storage_path('countries.sql')));
        DB::unprepared(file_get_contents(storage_path('cities.sql')));
        Model::reguard();
        /* Demo Stop*/
    }
}