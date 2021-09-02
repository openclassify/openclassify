<?php namespace Visiosoft\ClassifiedsModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\ClassifiedsModule\Notifications\ClassifiedsModuleNotificationsTemplateSeeder;
use Visiosoft\ClassifiedsModule\Status\StatusSeeder;

class ClassifiedsModuleSeeder extends Seeder
{
    public function run()
    {
        //Notifications Template Seeder
        $this->call(ClassifiedsModuleNotificationsTemplateSeeder::class);

        $this->call(StatusSeeder::class);
    }
}