<?php namespace Visiosoft\NotificationsModule\Template\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MailTemplate extends Notification implements ShouldQueue
{

    use Queueable;

    public $template;
    public $to;

    public function __construct($template, $to = null)
    {
        $this->template = $template;
        $this->to = $to;
    }


    public function via(UserInterface $notifiable)
    {
        return ['mail'];
    }

    public function toMail(UserInterface $notifiable)
    {
        if ($this->to != null) {
            $notifiable->email = $this->to;
        }

        $view = $this->template['view'] ? $this->template['view'] : 'visiosoft.module.notifications::notification';

        return (new MailMessage())
            ->view($view)
            ->subject($this->template['subject'])
            ->greeting($this->template['greeting'])
            ->line($this->template['message']);
    }
}
