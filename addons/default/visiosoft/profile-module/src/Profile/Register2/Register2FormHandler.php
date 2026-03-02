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

        $user->setAttribute('utm_source', (isset($_COOKIE['utm_source'])) ? $_COOKIE['utm_source'] : null);
        $user->setAttribute('utm_medium', (isset($_COOKIE['utm_medium'])) ? $_COOKIE['utm_medium'] : null);
        $user->setAttribute('utm_campaign', (isset($_COOKIE['utm_campaign'])) ? $_COOKIE['utm_campaign'] : null);
        $user->setAttribute('utm_term', (isset($_COOKIE['utm_term'])) ? $_COOKIE['utm_term'] : null);
        $user->setAttribute('utm_content', (isset($_COOKIE['utm_content'])) ? $_COOKIE['utm_content'] : null);
        $user->setAttribute('browser_lang', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

        //Save ip location
        try {
            $location = file_get_contents("https://ipinfo.io/json");
            $location = json_decode($location, true);
            $user->setAttribute('location_for_ip', $location['country']);
        } catch (\Exception $exception) {
        }


        $user->save();


        $builder->setFormEntry($register);

        $activator->start($user);

        $mode = config('anomaly.module.users::config.activation_mode', 'automatic');

        switch ($mode) {
            case 'automatic':
                dispatch_sync(new HandleAutomaticRegistration($builder));
                break;

            case 'manual':
                dispatch_sync(new HandleManualRegistration($builder));
                break;

            case 'email':
                dispatch_sync(new HandleEmailRegistration($builder));
                break;
        }

        $user = $builder->getFormEntry();

        foreach ($builder->getRoles() as $role) {
            if ($role = $this->dispatchSync(new GetRole($role))) {
                $user->attachRole($role);
            }
        }

        $events->dispatch(new UserHasRegistered($user));
    }
}
