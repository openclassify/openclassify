<?php namespace Visiosoft\LocationModule\District\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface DistrictRepositoryInterface extends EntryRepositoryInterface
{
    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc');

    public function getDistrictByCityId($city);
}
