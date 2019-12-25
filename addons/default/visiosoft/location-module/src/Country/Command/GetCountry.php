<?php namespace Visiosoft\LocationModule\Country\Command;

use Visiosoft\LocationModule\Country\CountryModel;

class GetCountry
{

    /**
     * @var $id
     */
    protected $id;

    /**
     * GetProduct constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param CountryModel $groups
     * @return |null
     */
    public function handle(CountryModel $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
