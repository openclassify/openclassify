<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class CreatedSiteMail extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Redirect here after activating.
     *
     * @var string
     */
    public $user;
    public $subdomain;
    public $loginDetail;

    /**
     * Create a new UserHasRegistered instance.
     *
     * @param $redirect
     */
    public function __construct($user,$subdomain,$loginDetail)
    {
        $this->user = $user;
        $this->subdomain = $subdomain;
        $this->loginDetail = $loginDetail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  UserInterface $notifiable
     * @return array
     */
    public function via(UserInterface $notifiable)
    {
        return ['mail'];
    }

    /**
     * Return the mail message.
     *
     * @param  UserInterface $notifiable
     * @return MailMessage
     */
    public function toMail(UserInterface $notifiable)
    {

        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.notifications::notification.created_site_subject',['sitename'=>$this->subdomain.".openclassify.com"]))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->user->display_name)
            ->line(trans('visiosoft.module.notifications::notification.created_site_line1'))
            ->line(trans('visiosoft.module.notifications::notification.created_site_username',['username' => $this->loginDetail['username']]))
            ->line(trans('visiosoft.module.notifications::notification.created_site_email',['email' => $this->loginDetail['email']]))
            ->line(trans('visiosoft.module.notifications::notification.created_site_password',['password' => $this->loginDetail['password']]))
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'))
            ->action(trans('visiosoft.module.notifications::notification.created_site_button'),'http://'.$this->subdomain.'.openclassify.com/admin');
    }
}
