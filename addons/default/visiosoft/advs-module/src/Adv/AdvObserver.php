<?php namespace Visiosoft\AdvsModule\Adv;

use Visiosoft\AdvsModule\Adv\Command\DeleteOptionConfiguration;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Visiosoft\AdvsModule\Adv\Event\DeletedAd;
use Visiosoft\AdvsModule\Adv\Event\DeletingAd;

class AdvObserver extends EntryObserver
{
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteOptionConfiguration($entry));

        event(new DeletingAd($entry));

        parent::deleting($entry);
    }

    public function deleted(EntryInterface $entry)
    {
        event(new DeletedAd($entry));
        parent::deleted($entry);
    }
}
