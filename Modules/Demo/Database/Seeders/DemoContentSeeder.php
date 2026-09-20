<?php

declare(strict_types=1);

namespace Modules\Demo\Database\Seeders;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DatabaseSeeder::class,
        ]);
    }
}
