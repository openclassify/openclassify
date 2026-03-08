<?php

namespace Modules\Demo\Database\Seeders;

use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\User\Database\Seeders\UserWorkspaceSeeder::class,
        ]);
    }
}
