<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;

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
     * @param ClassifiedRepositoryInterface $groups
     * @return |null
     */
    public function handle(ClassifiedRepositoryInterface $groups)
    {
        if ($this->id) {
            return $groups->find($this->id);
        }
        return null;
    }
}
