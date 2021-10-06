<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Anomaly\UsersModule\Role\Command\GetRole;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Anomaly\UsersModule\User\UserActivator;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleAutomaticRegistration;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleEmailRegistration;
use Visiosoft\ProfileModule\Profile\Register2\Command\HandleManualRegistration;

class Register2FormHandler
{
    use DispatchesJobs;

    public function handle(
        Dispatcher $events,
        UserRepositoryInterface $users,
        Register2FormBuilder $builder,
        UserActivator $activator
    )
    {
        if (!$builder->canSave()) {
            return;
        }

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

        if (isset($_COOKIE['utm_source'])) {
            $fields['utm_source'] = $_COOKIE['utm_source'];
        }

        unset(
            $fields['phone'],
            $fields['accept_protection_law'],
            $fields['accept_privacy_terms'],
            $fields['receive_sms_emails'],
            $fields['recaptcha_token']
        );

        $register = $users->create($fields);
        $register->setAttribute('password', $fields['password']);
        $users->save($register);

        /* @var UserInterface $user */
        $user = $register;
        $builder->setFormEntry($register);

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

	    $user = $builder->getFormEntry();

	    foreach ($builder->getRoles() as $role) {
		    if ($role = $this->dispatch(new GetRole($role))) {
			    $user->attachRole($role);
		    }
	    }

        $events->dispatch(new UserHasRegistered($user));
    }
}
