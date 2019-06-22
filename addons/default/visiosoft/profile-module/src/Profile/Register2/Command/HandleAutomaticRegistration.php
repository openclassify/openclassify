<?php namespace Visiosoft\ProfileModule\Profile\Register2\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Anomaly\UsersModule\User\UserActivator;
use Anomaly\UsersModule\User\UserAuthenticator;


/**
 * Class HandleAutomaticRegistration
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
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
    public function __construct(Register2FormBuilder $builder)
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
