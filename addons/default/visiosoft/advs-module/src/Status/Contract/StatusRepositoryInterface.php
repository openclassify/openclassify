<?php namespace Visiosoft\AdvsModule\Status\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface StatusRepositoryInterface extends EntryRepositoryInterface
{
    public function getUserAccessibleStatuses();
}
