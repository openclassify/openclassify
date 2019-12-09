<?php namespace Visiosoft\LocationModule\District\Command;

use Visiosoft\LocationModule\District\DistrictModel;

class GetDistrict
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
     * @param DistrictModel $groups
     * @return |null
     */
    public function handle(DistrictModel $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
