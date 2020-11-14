<?php namespace Visiosoft\LocationModule\Country\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CountryRepositoryInterface extends EntryRepositoryInterface
{
    public function findById($id);

    public function viewAll();

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc');
}
