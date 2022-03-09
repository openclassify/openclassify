<?php namespace Anomaly\SettingsModule\Listener;

use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class RefreshSettingsModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RefreshSettingsModule
{

    /**
     * Handle the event.
     *
     * @param SystemIsRefreshing $event
     */
    public function handle(SystemIsRefreshing $event)
    {
        $command = $event->getCommand();

        app(Kernel::class)->call('settings:dump');

        $command->info('Settings cache refreshed.');
    }
}
