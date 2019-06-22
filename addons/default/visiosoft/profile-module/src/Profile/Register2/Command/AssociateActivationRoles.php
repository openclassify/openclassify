<?php namespace Visiosoft\ProfileModule\Profile\Register2\Command;

use Anomaly\UsersModule\Role\Command\GetRole;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AssociateActivationRoles
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class AssociateActivationRoles
{

    use DispatchesJobs;

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
    public function __construct(Register2FormBuilder $builder)
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
            if ($role = $this->dispatch(new GetRole($role))) {
                $user->attachRole($role);
            }
        }
    }
}
