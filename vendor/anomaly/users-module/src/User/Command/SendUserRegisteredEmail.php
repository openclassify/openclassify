<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Notification\ActivateYourAccount;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SendUserRegisteredEmail
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SendUserRegisteredEmail
{

    use DispatchesJobs;

    /**
     * The user instance.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new SendUserRegisteredEmail instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command.
     *
     * @return bool
     */
    public function handle()
    {
        $this->user->notify(new ActivateYourAccount($this->redirect));
    }
}
