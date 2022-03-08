<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendDemandMail extends Notification implements ShouldQueue
{

    use Queueable;

    private $url;
    private $user;
    private $demandID;

    public function __construct($url, $user, $demandID, $locale)
    {
        $this->url = $url;
        $this->user = $user;
        $this->demandID = $demandID;
        $this->locale = $locale;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('theme::notifications/demand-created', [
                'url' => $this->url,
                'name' => $this->user->name(),
                'site_name' => setting_value('streams::name'),
                'number' => $this->demandID,
                'locale' => $this->locale,
            ])
            ->subject(trans('visiosoft.theme.emlak24::field.we_received_your_request'));
    }
}
