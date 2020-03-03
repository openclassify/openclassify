<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Visiosoft\ProfileModule\Profile\ProfileModel;
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
     * @param Dispatcher $events
     * @param UserRepositoryInterface $users
     * @param Register2FormBuilder $builder
     * @param UserActivator $activator
     */
    public function handle(
        Repository $config,
        Dispatcher $events,
        UserRepositoryInterface $users,
        Register2FormBuilder $builder,
        UserActivator $activator
    )
    {
        if (!$builder->canSave()) {
            return;
        }

        $profile_parameters = array();

        /* Create Profile in Register */
        $domain = setting_value('streams::domain');
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('/', '', $domain);
        $domain = str_replace('www', '', $domain);

        if (!setting_value('visiosoft.module.advs::register_email_field')) {
            $builder->setFormValue('email', $builder->getPostValue('username') . "@" . $domain);
        }

        $fields = $builder->getPostData();
        $fields['display_name'] = $fields['first_name'] . " " . $fields['last_name'];
        $fields['gsm_phone'] = $builder->getPostValue('phone');
        unset($fields['phone']);

        $register = $users->create($fields);
        $register->setAttribute('password', $fields['password']);
        $users->save($register);

        /* @var UserInterface $user */
        $user = $register;

        $activator->start($user);
        $activator->force($user);

        $events->dispatch(new UserHasRegistered($user));
    }
}
