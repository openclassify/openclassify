<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class GetUserAds
{
    protected $userID;
    protected $status;

    public function __construct($userID, $status = "approved")
    {
        $this->userID = $userID;
        $this->status = $status;
    }

    public function handle(AdvRepositoryInterface $advRepository)
    {
        return $advRepository->getUserAds($this->userID, $this->status);
    }
}
