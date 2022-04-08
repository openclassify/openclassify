<?php namespace Anomaly\Streams\Platform\Support;

use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Observer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Observer
{

    use FiresCallbacks;

    /**
     * @deprecated Removed hard __construct injection in 1.7.
     *             Remove completely in 1.8
     */
    use DispatchesJobs;

    /**
     * Create a new EloquentObserver instance.
     *
     * @deprecated Removed hard __construct injection in 1.7.
     *             Remove completely in 1.8
     */
    public function __construct()
    {
        $this->events   = app('events');
        $this->commands = app(Dispatcher::class);
    }
}
