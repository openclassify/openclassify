<?php namespace Visiosoft\LocationModule\Country;

use Visiosoft\LocationModule\Country\Contract\CountryInterface;
use Anomaly\Streams\Platform\Model\Location\LocationCountriesEntryModel;

class CountryModel extends LocationCountriesEntryModel implements CountryInterface
{
    /**
     *
     * The connection which is associated with the model.
     *
     */
    protected $connection = 'mysql';
}
