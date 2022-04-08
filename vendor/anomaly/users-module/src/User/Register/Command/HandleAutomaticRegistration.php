<?php namespace Anomaly\UsersModule\User\Register\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Register\RegisterFormBuilder;
use Anomaly\UsersModule\User\UserActivator;
use Anomaly\UsersModule\User\UserAuthenticator;


/**
 * Class HandleAutomaticRegistration
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class HandleAutomaticRegistration
{

    /**
     * The form builder.
     *
     * @var RegisterFormBuilder
     */
    protected $builder;

    /**
     * Create a new HandleAutomaticRegistration instance.
     *
     * @param RegisterFormBuilder $builder
     */
    public function __construct(RegisterFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param UserAuthenticator $authenticator
     * @param UserActivator     $activator
     * @param MessageBag        $messages
     */
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
