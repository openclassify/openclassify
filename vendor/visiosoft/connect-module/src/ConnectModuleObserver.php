<?php namespace Visiosoft\ConnectModule;

use Visiosoft\ConnectModule\Command\PurgeHttpCache;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Observer;

/**
 * Class ConnectModuleObserver
 *

 */
class ConnectModuleObserver extends Observer
{

    /**
     * Fired just after saving.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        dispatch_now(new PurgeHttpCache($entry));
    }
}
