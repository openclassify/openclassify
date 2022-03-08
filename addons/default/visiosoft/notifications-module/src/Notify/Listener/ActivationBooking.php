<?php namespace Visiosoft\NotificationsModule\Notify\Listener;


use Anomaly\UsersModule\User\UserModel;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\NotificationsModule\Notify\Notification\ActivationBookingMail;

class ActivationBooking
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

    /**
     * @param \Visiosoft\BookingModule\Booking\Events\CreateBooking $event
     */
    public function handle(\Visiosoft\BookingModule\Booking\Events\ActivationBooking $event)
    {
        $template = app(TemplateRepositoryInterface::class);

        try {
            if ($template->checkSetting() === true) {
                $this->user->find(1)->notify(new ActivationBookingMail($event->detail()));
            }
        } catch (\Exception $e) {}
    }
}
