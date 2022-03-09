<?php namespace Anomaly\UsersModule\User\Register;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Anomaly\UsersModule\User\Register\Command\HandleAutomaticRegistration;
use Anomaly\UsersModule\User\Register\Command\HandleEmailRegistration;
use Anomaly\UsersModule\User\Register\Command\HandleManualRegistration;
use Anomaly\UsersModule\User\UserActivator;

/**
 * Class RegisterFormHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterFormHandler
{

    /**
     * Handle the form.
     *
     * @param  RegisterFormBuilder $builder
     * @param  UserActivator $activator
     * @throws \Exception
     */
    public function handle(
        RegisterFormBuilder $builder,
        UserActivator $activator
    ) {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm(); // Save the new user.

        /* @var UserInterface $user */
        $user = $builder->getFormEntry();

        $activator->start($user);

        $mode = config('anomaly.module.users::config.activation_mode', 'automatic');

        switch ($mode) {
            case 'automatic':
                dispatch_now(new HandleAutomaticRegistration($builder));
                break;

            case 'manual':
                dispatch_now(new HandleManualRegistration($builder));
                break;

            case 'email':
                dispatch_now(new HandleEmailRegistration($builder));
                break;
        }

        event(new UserHasRegistered($user));
    }
}
