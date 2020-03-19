<?php namespace Visiosoft\LocationModule\City\Command;

use Visiosoft\LocationModule\City\CityModel;

class GetCities
{

    /**
     * @var $country
     */
    protected $country;

    /**
     * GetProduct constructor.
     * @param $country
     */
    public function __construct($country)
    {
        $this->country = $country;
    }


    /**
     * @param CityModel $groups
     * @return |null
     */
    public function handle(CityModel $groups)
    {
        if ($this->country) {
            return $groups->where('parent_country_id', $this->country)->get();
        }
        return $groups::query()->get();
    }
}
