<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\CatsModule\Placeholderforsearch\PlaceholderforsearchSeeder;

class CatsModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(PlaceholderforsearchSeeder::class);
    }
}