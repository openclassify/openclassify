<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Notification\ActivateYourAccount;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class SendActivationEmail
{
    use DispatchesJobs;

    /**
     * The user instance.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * The redirect path.
     *
     * @var string
     */
    protected $redirect;

    /**
     * Create a new SendActivationEmail instance.
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
        $this->user->notify(new ActivateYourAccount($this->redirect));
    }
}
