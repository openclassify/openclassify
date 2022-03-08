<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendDemandMailAdmin extends Notification implements ShouldQueue
{

    use Queueable;

    private $content;
    private $subject;
    private $url;

    public function __construct($content, $subject, $url, $locale)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->url = $url;
        $this->locale = $locale;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('theme::notifications/email', [
                'content' => $this->content,
                'locale' => $this->locale,
            ])
            ->subject($this->subject);
    }
}
