<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;

class GetUserClassifieds
{
    protected $userID;
    protected $status;

    public function __construct($userID, $status = "approved")
    {
        $this->userID = $userID;
        $this->status = $status;
    }

    public function handle(ClassifiedRepositoryInterface $classifiedRepository)
    {
        return $classifiedRepository->getUserClassifieds($this->userID, $this->status);
    }
}
