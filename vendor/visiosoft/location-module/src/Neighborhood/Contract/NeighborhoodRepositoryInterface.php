<?php namespace Visiosoft\LocationModule\Neighborhood\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface NeighborhoodRepositoryInterface extends EntryRepositoryInterface
{
    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc');

    public function getNeighborhoodsByDistrictId($district);
}
