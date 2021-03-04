<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\AdvsModule\Status\StatusSeeder;

class AdvsModuleSeeder extends Seeder
{
    public function run()
    {
        $this->call(StatusSeeder::class);
    }
}