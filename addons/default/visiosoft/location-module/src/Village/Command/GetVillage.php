<?php namespace Visiosoft\LocationModule\Village\Command;


use Visiosoft\LocationModule\Village\VillageModel;

class GetVillage
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
     * @param VillageModel $groups
     * @return |null
     */
    public function handle(VillageModel $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
