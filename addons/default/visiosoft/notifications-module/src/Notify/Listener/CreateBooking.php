<?php namespace Visiosoft\NotificationsModule\Notify\Listener;


use Anomaly\UsersModule\User\UserModel;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\NotificationsModule\Notify\Notification\CreateBookingMail;

class CreateBooking
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
    public function handle(\Visiosoft\BookingModule\Booking\Events\CreateBooking $event)
    {
        $template = app(TemplateRepositoryInterface::class);

        try {
            if ($template->checkSetting() === true) {
                //Send System Admin
                $this->user->find(1)->notify(new CreateBookingMail($event->detail(), $event->location(), $event->service()));

                //Send Booking User
                $this->user->find(1)->notify(new CreateBookingMail($event->detail(), $event->location(), $event->service(), $event->detail()->email));
            }
        } catch (\Exception $e) {}
    }
}
