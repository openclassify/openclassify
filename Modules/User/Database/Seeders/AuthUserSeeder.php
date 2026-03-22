<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\App\Models\User;
use Modules\User\App\Support\DemoUserCatalog;
use Spatie\Permission\Models\Role;

class AuthUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect(DemoUserCatalog::records())
            ->map(fn (array $record): User => User::query()->updateOrCreate(
                ['email' => $record['email']],
                [
                    'name' => $record['name'],
                    'password' => $record['password'],
                    'status' => 'active',
                ],
            ));

        $adminRole = Role::query()->firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $users->each(function (User $user) use ($adminRole): void {
            if (DemoUserCatalog::isAdmin($user->email)) {
                $user->syncRoles([$adminRole->name]);

                return;
            }

            $user->syncRoles([]);
        });
    }
}
