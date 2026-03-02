<?php namespace Visiosoft\ProfileModule\Support\Command;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;

class getAdminUsers
{
    public function handle()
    {
        $adminRole = app(RoleRepositoryInterface::class)->findBySlug('admin');
        return $adminRole->getUsers();
    }
}
