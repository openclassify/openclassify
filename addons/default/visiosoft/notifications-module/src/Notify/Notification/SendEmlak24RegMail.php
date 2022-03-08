<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendEmlak24RegMail extends Notification implements ShouldQueue
{

    use Queueable;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('theme::notifications/user-registered', [
                'url' => url('/'),
                'name' => $this->user->name(),
                'site_name' => setting_value('streams::name'),
            ])
            ->subject(trans('visiosoft.theme.emlak24::field.welcome'));
    }
}
