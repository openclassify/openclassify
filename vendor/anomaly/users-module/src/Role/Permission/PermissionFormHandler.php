<?php namespace Anomaly\UsersModule\Role\Permission;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\Role\Contract\RoleInterface;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Routing\Redirector;

/**
 * Class PermissionFormHandler
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PermissionFormHandler
{

    /**
     * Handle the form.
     *
     * @param PermissionFormBuilder   $builder
     * @param RoleRepositoryInterface $roles
     * @param Redirector              $redirect
     */
    public function handle(PermissionFormBuilder $builder, RoleRepositoryInterface $roles, Redirector $redirect)
    {
        /* @var RoleInterface|EloquentModel $role */
        $role = $builder->getEntry();

        $roles->save($role->setAttribute('permissions', array_filter(array_flatten($builder->getFormInput()))));

        $builder->setFormResponse($redirect->refresh());
    }
}
