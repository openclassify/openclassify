<?php namespace Anomaly\RedirectsModule\Listener;

use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class RefreshRedirectsModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RefreshRedirectsModule
{

    /**
     * Handle the event.
     *
     * @param SystemIsRefreshing $event
     */
    public function handle(SystemIsRefreshing $event)
    {
        $command = $event->getCommand();

        app(Kernel::class)->call('redirects:dump');

        $command->info('Redirects cache refreshed.');
    }
}
