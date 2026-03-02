<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\AdvsModule\Notifications\AdvsModuleNotificationsTemplateSeeder;
use Visiosoft\AdvsModule\Status\StatusSeeder;

class AdvsModuleSeeder extends Seeder
{
    public function run()
    {
        //Notifications Template Seeder
        $this->call(AdvsModuleNotificationsTemplateSeeder::class);

        $this->call(StatusSeeder::class);
    }
}