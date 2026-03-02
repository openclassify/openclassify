<?php namespace Visiosoft\LocationModule\City\Command;

use Visiosoft\LocationModule\City\CityModel;

class GetCity
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
     * @param CityModel $groups
     * @return |null
     */
    public function handle(CityModel $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
