<?php namespace Anomaly\UsersModule\User\Permission;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
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
     * @param UserRepositoryInterface $users
     * @param Redirector              $redirect
     */
    public function handle(
        PermissionFormBuilder $builder,
        UserRepositoryInterface $users,
        Redirector $redirect
    )
    {
        /* @var UserInterface|EloquentModel $user */
        $user = $builder->getEntry();

        $users->save(
            $user->setAttribute(
                'permissions',
                array_filter(array_flatten($builder->getFormInput()))
            )
        );

        $builder->setFormResponse($redirect->refresh());
    }

}
