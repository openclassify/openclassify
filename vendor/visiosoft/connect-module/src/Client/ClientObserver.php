<?php namespace Visiosoft\ConnectModule\Client;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

class ClientObserver extends EntryObserver
{
    public function updating(EntryInterface $entry)
    {
        parent::updating($entry);
    }

    public function deleting(EntryInterface $entry)
    {
        parent::deleting($entry);
    }

    public function deleted(EntryInterface $entry)
    {
        parent::deleted($entry);
    }
}
