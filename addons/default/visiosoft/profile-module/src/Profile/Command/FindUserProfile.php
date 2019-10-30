<?php namespace Visiosoft\ProfileModule\Profile\Command;

use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;

class FindUserProfile
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
     * @param ProfileRepositoryInterface $profileRepository
     * @return |null
     */
    public function handle(ProfileRepositoryInterface $profileRepository)
    {
        if ($this->id) {
            return $profileRepository->findByUserID($this->id);
        }
        return null;
    }
}
