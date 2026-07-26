<?php

declare(strict_types=1);

namespace Modules\Demo\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\Seeders\UserWorkspaceSeeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserWorkspaceSeeder::class,
        ]);
    }
}
