<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CancellationBookingMail extends Notification implements ShouldQueue
{
    use Queueable;

    private $detail;
    private $location;
    private $service;
    private $staff;

    /**
     * CancellationBookingMail constructor.
     * @param $detail
     * @param $location
     * @param $service
     * @param $staff
     */
    public function __construct($detail, $location,$service,$staff)
    {
        $this->detail = $detail;
        $this->location = $location;
        $this->staff = $staff;
        $this->service = $service;
    }

    /**
     * @param UserInterface $notifiable
     * @return array
     */
    public function via(UserInterface $notifiable)
    {
        return ["mail"];
    }

    /**
     * @param UserInterface $notifiable
     * @return MailMessage
     */
    public function toMail(UserInterface $notifiable)
    {
        $notifiable->email = $this->detail->email;

        $mesage = (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.booking::messages.cancellation_mail_subject'))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->detail->name)
            ->line(trans('visiosoft.module.booking::messages.cancellation_mail_message'))
            ->line('<br>'.$this->detail->booking_datetime_start)
            ->line('<hr>')
            ->line($this->service->name.'<br>'.$this->staff->name."<br>".$this->location->name."<br>".$this->location->phone)
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));
        return $mesage;
    }
}
