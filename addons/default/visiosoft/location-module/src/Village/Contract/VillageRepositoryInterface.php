<?php namespace Visiosoft\LocationModule\Village\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface VillageRepositoryInterface extends EntryRepositoryInterface
{
    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc');

    public function getVillagesByNeighborhoodId($neighborhood);
}
