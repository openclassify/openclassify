<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Visiosoft\ProfileModule\Profile\ProfileModel;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleAutomaticRegistration;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleEmailRegistration;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleManualRegistration;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RegisterFormHandler
 *
 * @link   http://openclassify.com/
 * @author OpenClassify, Inc. <support@openclassify.com>
 * @author Visiosoft Inc <support@openclassify.com>
 */
class Register2FormHandler
{

    use DispatchesJobs;

    /**
     * Handle the form.
     *
     * @param Repository $config
     * @param RegisterFormBuilder $builder
     * @param UserActivator $activator
     * @throws \Exception
     */
    public function handle(
        Repository $config,
        Dispatcher $events,
        Register2FormBuilder $builder,
        UserActivator $activator
    )
    {

        if (!$builder->canSave()) {
            return;
        }
        $builder->saveForm(); // Save the new user.

        /* @var UserInterface $user */
        $user = $builder->getFormEntry();
        /* Create Profile in Register */
        ProfileModel::query()->create(['user_no_id' => $user->getId()]);

        $activator->start($user);

        $mode = $config->get('anomaly.module.users::config.activation_mode', 'automatic');

        switch ($mode) {
            case 'automatic':
                $this->dispatch(new HandleAutomaticRegistration($builder));
                break;

            case 'manual':
                $this->dispatch(new HandleManualRegistration($builder));
                break;

            case 'email':
                $this->dispatch(new HandleEmailRegistration($builder));
                break;
        }
        $events->dispatch(new UserHasRegistered($user));
    }
}
