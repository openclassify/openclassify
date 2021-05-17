<?php namespace Visiosoft\LocationModule\City\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CityRepositoryInterface extends EntryRepositoryInterface
{
    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc');

    public function getCitiesByCountryId($country_id);

    public function findAllByIDs($citiesIDs);
}
