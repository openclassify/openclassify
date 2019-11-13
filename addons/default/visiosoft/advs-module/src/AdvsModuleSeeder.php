<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Visiosoft\AdvsModule\Seed\BlockSeeder;

class AdvsModuleSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(BlockSeeder::class);
    }
}