<?php namespace Anomaly\UsersModule\User\Password\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Notification\ResetYourPassword;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Notifications\Notifiable;

/**
 * Class SendResetEmail
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SendResetEmail
{

    use DispatchesJobs;

    /**
     * The user instance.
     *
     * @var UserInterface|Notifiable
     */
    protected $user;

    /**
     * The redirect path.
     *
     * @var string
     */
    protected $redirect;

    /**
     * Create a new SendResetEmail instance.
     *
     * @param UserInterface $user
     * @param string        $redirect
     */
    public function __construct(UserInterface $user, $redirect = '/')
    {
        $this->user     = $user;
        $this->redirect = $redirect;
    }

    /**
     * Handle the command.
     *
     * @return bool
     */
    public function handle()
    {
        return $this->user->notify(new ResetYourPassword($this->redirect));
    }
}
