<?php namespace Visiosoft\CatsModule\Placeholderforsearch;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceholderforsearchSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        DB::table('cats_placeholderforsearch')->truncate();
        DB::table('cats_placeholderforsearch_translations')->truncate();
        PlaceholderforsearchModel::create([
            'en' => [
                'name' => 'Chevrolet Camaro'
            ],
            'tr' => [
                'name' => 'Chevrolet Camaro'
            ]
        ]);
        PlaceholderforsearchModel::create([
            'en' => [
                'name' => 'Xiaomi Black Shark 128 GB'
            ],
            'tr' => [
                'name' => 'Xiaomi Black Shark 128 GB'
            ]
        ]);
        PlaceholderforsearchModel::create([
            'en' => [
                'name' => 'Apple MacBook Pro'
            ],
            'tr' => [
                'name' => 'Apple MacBook Pro'
            ]
        ]);
        PlaceholderforsearchModel::create([
            'en' => [
                'name' => 'Make your search now'
            ],
            'tr' => [
                'name' => 'Make your search now'
            ]
        ]);
    }
}
