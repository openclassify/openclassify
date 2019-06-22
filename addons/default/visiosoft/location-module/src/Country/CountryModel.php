<?php namespace Visiosoft\LocationModule\Country;

use Visiosoft\LocationModule\Country\Contract\CountryInterface;
use Anomaly\Streams\Platform\Model\Location\LocationCountriesEntryModel;

class CountryModel extends LocationCountriesEntryModel implements CountryInterface
{
    public function getCountry($id)
    {
        return CountryModel::query()->where('location_countries.id', $id)->first();
    }
}
