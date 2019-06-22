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

        /* Demo Start */
        Model::unguard();
        DB::unprepared(file_get_contents(__DIR__.'/Country/countries.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/City/cities.sql'));
        DB::unprepared(file_get_contents(__DIR__.'/District/districts.sql'));
         DB::unprepared(file_get_contents(__DIR__.'/Neighborhood/neighborhoods.sql'));
        Model::reguard();
        /* Demo Stop*/
    }
}