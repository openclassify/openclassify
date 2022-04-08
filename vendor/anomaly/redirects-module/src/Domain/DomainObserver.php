<?php namespace Anomaly\RedirectsModule\Domain;

use Anomaly\RedirectsModule\Domain\Command\DumpDomains;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class DomainObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DomainObserver extends EntryObserver
{

    /**
     * Fired just after saving.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        parent::saved($entry);

        dispatch_now(new DumpDomains());
    }
}
