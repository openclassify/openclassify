<?php namespace Visiosoft\ProfileModule\Profile\Register2\Command;

use Anomaly\UsersModule\User\UserActivator;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;

class HandleEmailRegistration
{
    protected $builder;

    public function __construct(Register2FormBuilder $builder)
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
