<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class LatestAds
{

    /**
     * @param AdvRepositoryInterface $groups
     * @return |null
     */
    public function handle(AdvRepositoryInterface $advRepository)
    {
        return $advRepository->latestAds();
    }
}
