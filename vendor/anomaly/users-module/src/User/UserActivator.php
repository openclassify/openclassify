<?php namespace Anomaly\UsersModule\User;

use Anomaly\UsersModule\User\Command\ActivateUserByCode;
use Anomaly\UsersModule\User\Command\ActivateUserByForce;
use Anomaly\UsersModule\User\Command\SendActivationEmail;
use Anomaly\UsersModule\User\Command\StartUserActivation;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserActivator
{
    use DispatchesJobs;

    /**
     * Start a user activation process.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function start(UserInterface $user)
    {
        return $this->dispatch(new StartUserActivation($user));
    }

    /**
     * Activate a user by code.
     *
     * @param  UserInterface $user
     * @param                $code
     * @return bool
     */
    public function activate(UserInterface $user, $code)
    {
        return $this->dispatch(new ActivateUserByCode($user, $code));
    }

    /**
     * Activate a user by force.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function force(UserInterface $user)
    {
        return $this->dispatch(new ActivateUserByForce($user));
    }

    /**
     * Send an activation email.
     *
     * @param  UserInterface $user
     * @param  string        $redirect
     * @return bool
     */
    public function send(UserInterface $user, $redirect = '/')
    {
        return $this->dispatch(new SendActivationEmail($user, $redirect));
    }
}
