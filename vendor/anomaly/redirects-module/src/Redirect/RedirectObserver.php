<?php namespace Anomaly\RedirectsModule\Redirect;

use Anomaly\RedirectsModule\Redirect\Command\DumpRedirects;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class RedirectObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectObserver extends EntryObserver
{

    /**
     * Fired just after an entry is saved.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        parent::saved($entry);

        dispatch_now(new DumpRedirects());
    }

}
