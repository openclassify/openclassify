<?php namespace Visiosoft\LocationModule\Neighborhood\Command;

use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;

class GetNeighborhood
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
     * @param NeighborhoodModel $groups
     * @return |null
     */
    public function handle(NeighborhoodModel $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
