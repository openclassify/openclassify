<?php namespace Visiosoft\AdvsModule\Adv;

use Visiosoft\AdvsModule\Adv\Command\DeleteOptionConfiguration;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

class AdvObserver extends EntryObserver
{
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteOptionConfiguration($entry));

        parent::deleting($entry);
    }
}
