<?php namespace Anomaly\Streams\Platform\Traits;

use Anomaly\Streams\Platform\Notification\Event\Transmission;
use Illuminate\Notifications\Notification;

/**
 * Class Transmitter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait Transmitter
{

    /**
     * Transmit the notification.
     *
     * @param Notification $notification
     */
    public function transmit(Notification $notification)
    {
        event(new Transmission($notification));
    }
}
