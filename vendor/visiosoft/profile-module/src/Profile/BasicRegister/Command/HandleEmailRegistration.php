<?php namespace Visiosoft\ProfileModule\Profile\BasicRegister\Command;

use Anomaly\UsersModule\User\UserActivator;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Visiosoft\ProfileModule\Profile\BasicRegister\BasicRegisterFormBuilder;

class HandleEmailRegistration
{
    protected $builder;

    public function __construct(BasicRegisterFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle(UserActivator $activator, MessageBag $messages)
    {
        /* @var UserInterface $user */
        $user = $this->builder->getFormEntry();

        $activator->send($user, $this->builder->getFormOption('activate_redirect', '/'));

        if (!is_null($message = $this->builder->getFormOption('confirm_message'))) {
            $messages->info($message);
        }
    }
}
