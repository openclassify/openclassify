<?php namespace Anomaly\UsersModule\User\Register\Command;

use Anomaly\UsersModule\Role\Command\GetRole;
use Anomaly\UsersModule\User\Register\RegisterFormBuilder;

/**
 * Class AssociateActivationRoles
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AssociateActivationRoles
{
    /**
     * The form builder.
     *
     * @var RegisterFormBuilder
     */
    protected $builder;

    /**
     * Create a new AssociateActivationRoles instance.
     *
     * @param RegisterFormBuilder $builder
     */
    public function __construct(RegisterFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var UserInterface $user */
        $user = $this->builder->getFormEntry();

        foreach ($this->builder->getRoles() as $role) {
            if ($role = dispatch_sync(new GetRole($role))) {
                $user->attachRole($role);
            }
        }
    }
}
