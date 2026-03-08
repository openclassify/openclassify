<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\User\App\Models\User;
use Spatie\Permission\Models\Role;

class AuthUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'a@a.com'],
            [
                'name' => 'Admin',
                'password' => '236330',
                'status' => 'active',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'b@b.com'],
            [
                'name' => 'Member',
                'password' => '236330',
                'status' => 'active',
            ],
        );

        if (! class_exists(Role::class) || ! Schema::hasTable((new Role())->getTable())) {
            return;
        }

        $adminRole = Role::query()->firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $admin->syncRoles([$adminRole->name]);
    }
}
