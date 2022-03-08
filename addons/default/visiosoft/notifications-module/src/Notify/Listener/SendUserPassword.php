<?php namespace Visiosoft\NotificationsModule\Notify\Listener;


use Anomaly\UsersModule\User\UserModel;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\NotificationsModule\Notify\Notification\SendUserPasswordMail;

class SendUserPassword
{
    private $events;
    private $user;

    /**
     * CreateBooking constructor.
     * @param UserModel $userModel
     * @param Dispatcher $events
     */
    public function __construct(UserModel $userModel, Dispatcher $events)
    {
        $this->user = $userModel;
        $this->events = $events;
    }

    public function handle(\Visiosoft\BookingModule\Booking\Events\SendUserPassword $event)
    {
        $this->user->find(1)->notify(new SendUserPasswordMail($event->user(), $event->password()));
    }
}
