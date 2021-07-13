<?php namespace Visiosoft\ProfileModule\Profile\BasicRegister\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Visiosoft\ProfileModule\Profile\BasicRegister\BasicRegisterFormBuilder;
use Anomaly\UsersModule\User\UserActivator;
use Anomaly\UsersModule\User\UserAuthenticator;

class HandleAutomaticRegistration
{
    protected $builder;

    public function __construct(BasicRegisterFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle(UserAuthenticator $authenticator, UserActivator $activator, MessageBag $messages)
    {
        /* @var UserInterface $user */
        $user = $this->builder->getFormEntry();

        $activator->force($user);
        $authenticator->login($user);

        if (!is_null($message = $this->builder->getFormOption('activated_message'))) {
            $messages->info($message);
        }

        $messages->success('anomaly.module.users::message.logged_in');
    }
}
