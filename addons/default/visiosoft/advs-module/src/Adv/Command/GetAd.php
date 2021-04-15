<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class GetAd
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
     * @param AdvRepositoryInterface $groups
     * @return |null
     */
    public function handle(AdvRepositoryInterface $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
