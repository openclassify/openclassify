<?php namespace Visiosoft\LocationModule\City\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CityRepositoryInterface extends EntryRepositoryInterface
{
    public function findById($id);

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy);
}
