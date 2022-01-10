<?php namespace Visiosoft\AdvsModule\Status;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

class StatusObserver extends EntryObserver
{
    public function deleting(EntryInterface $entry)
    {
        if ($entry->is_system) {
            abort(403, trans('visiosoft.module.advs::message.you_can_not_delete_a_system_status'));
        }

        parent::deleting($entry);
    }
}
