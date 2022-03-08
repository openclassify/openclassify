<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\BookingModule\Booking\BookingModel;
use Visiosoft\BookingModule\Booking\Events\remindingTomorrow;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class remindingTomorrowMail
{
    private $ad;
    private $template;
    private $user;

    public function __construct(
        BookingModel $ad,
        UserRepositoryInterface $user,
        TemplateRepositoryInterface $template)
    {
        $this->ad = $ad;
        $this->template = $template;
        $this->user = $user;
    }

    public function handle(remindingTomorrow $event)
    {
        $booking_detail = array_merge($event->getBooking()->toArray(), [
            'service' => $event->getService()->name,
            'location' => $event->getLocation()->name,
            'staff' => $event->getStaff()->name,
            'date' => $event->getBooking()->booking_datetime_start,
        ]);
        $user = $this->user->first();
        $template = $this->template->findBySlug('reminding_tomorrow_booking');
        if (!is_null($template)) {
            $user->notify(new MailTemplate($template->getTemplateForArray($booking_detail), $booking_detail['email']));
        }
    }
}
