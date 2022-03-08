<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\User\UserModel;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\NotificationsModule\Notify\Notification\CancellationBookingMail;

class CancellationBooking
{
    private $events;
    private $user;

    /**
     * CancellationBooking constructor.
     * @param UserModel $userModel
     * @param Dispatcher $events
     */
    public function __construct(UserModel $userModel, Dispatcher $events)
    {
        $this->user = $userModel;
        $this->events = $events;
    }

    /**
     * @param \Visiosoft\BookingModule\Booking\Events\CancellationBooking $event
     */
    public function handle(\Visiosoft\BookingModule\Booking\Events\CancellationBooking $event)
    {
        $template = app(TemplateRepositoryInterface::class);

        try {
            if ($template->checkSetting()) {
                $this->user->find(1)->notify(new CancellationBookingMail($event->detail(), $event->location(), $event->service(), $event->staff()));
            }
        } catch (\Exception $e) {}
    }
}
