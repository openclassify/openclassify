<?php namespace Anomaly\PagesModule\Listener;

use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class RefreshPagesModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RefreshPagesModule
{

    /**
     * Handle the command.
     *
     * @param SystemIsRefreshing $event
     */
    public function handle(SystemIsRefreshing $event)
    {
        $command = $event->getCommand();

        app(Kernel::class)->call('pages:dump');

        $command->info('Pages cache refreshed.');

    }
}
