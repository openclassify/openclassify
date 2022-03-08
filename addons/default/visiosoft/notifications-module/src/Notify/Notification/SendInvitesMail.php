<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SendInvitesMail extends Notification implements ShouldQueue
{

    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $siteName = setting_value('streams::name');

        return (new MailMessage)
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.references::field.you_have_been_invited'))
            ->greeting(auth()->user()->name() . ' ' . trans('visiosoft.module.references::field.invited_you'))
            ->line(trans('visiosoft.module.references::field.invite_message', ['siteName' => $siteName]))
            ->action('Visit Site', route('references::referenceUser', [auth()->id()]))
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));
    }
}
