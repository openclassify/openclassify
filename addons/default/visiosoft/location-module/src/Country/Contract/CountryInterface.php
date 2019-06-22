<?php namespace Visiosoft\LocationModule\Country\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CountryInterface extends EntryInterface
{
    public function getCountry($id);
}
