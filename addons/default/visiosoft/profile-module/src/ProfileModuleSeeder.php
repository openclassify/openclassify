<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\ProfileModule\Education\EducationSeeder;
use Visiosoft\ProfileModule\Notifications\ProfileModuleNotificationsTemplateSeeder;
use Visiosoft\ProfileModule\Seed\UsersFieldsSeeder;

class ProfileModuleSeeder extends Seeder
{
    public function run()
    {
        //Notifications Template Seeder
        $this->call(ProfileModuleNotificationsTemplateSeeder::class);

        // Users Fields Seeder
        $this->call(UsersFieldsSeeder::class);

        //Educations Seeder
        $this->call(EducationSeeder::class);
    }
}