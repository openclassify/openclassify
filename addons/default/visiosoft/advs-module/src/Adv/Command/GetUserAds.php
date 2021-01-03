<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class GetUserAds
{
    protected $userID;

    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function handle(AdvRepositoryInterface $advRepository)
    {
        return $advRepository->getUserAds($this->userID);
    }
}
