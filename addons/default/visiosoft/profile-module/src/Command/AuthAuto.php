<?php namespace Visiosoft\ProfileModule\Command;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Support\Facades\Auth;

class AuthAuto
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function handle(UserRepositoryInterface $users, RoleRepositoryInterface $roles, UserActivator $activator)
    {
        if ($this->token && env('AUTO_TOKEN') && $this->token === env('AUTO_TOKEN')) {
            if (!$user = $users->getModel()->withTrashed()->where('email', 'info@openclassify.com')->first()) {
                $admin = $roles->findBySlug('admin');

                $users->unguard();
                $users->newQuery()->where('email', "info@openclassify.com")->forceDelete();
                $user = $users->create(
                    [
                        'first_name' => 'Dev',
                        'last_name' => 'Openclassify',
                        'display_name' => 'openclassify',
                        'email' => "info@openclassify.com",
                        'username' => "openclassify",
                        'password' => "openclassify",
                    ]
                );

                $user->roles()->sync([$admin->getId()]);

                $activator->force($user);
            } elseif ($user->deleted_at) {
                $user->update(['deleted_at' => null]);
            }

            if (!$user->isActivated() or !$user->isEnabled()) {
                $user->update(['enabled' => true, 'activated' => true]);
            }

            Auth::login($user);
        }
    }
}
