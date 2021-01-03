<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class getPopular
{
    public function handle(AdvRepositoryInterface $repository)
    {
        $ads = $repository->getPopular();

        $ads = $repository->getModel()->getLocationNames($ads);

        foreach ($ads as $index => $ad) {
            $ads[$index]->detail_url = $repository->getModel()->getAdvDetailLinkByModel($ad, 'list');
            $ads[$index] = $repository->getModel()->AddAdsDefaultCoverImage($ad);
        }

        return $ads;
    }
}
