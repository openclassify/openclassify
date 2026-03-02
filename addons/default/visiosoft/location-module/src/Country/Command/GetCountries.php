<?php namespace Visiosoft\LocationModule\Country\Command;

use Visiosoft\LocationModule\Country\CountryModel;

class GetCountries
{

    public function handle(CountryModel $groups)
    {
        return $groups::query()->get();
    }
}
