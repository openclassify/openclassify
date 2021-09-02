<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;

class getPopular
{
    public function handle(ClassifiedRepositoryInterface $repository)
    {
        $classifieds = $repository->getPopular();

        $classifieds = $repository->getModel()->getLocationNames($classifieds);

        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $repository->getModel()->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $repository->getModel()->AddClassifiedsDefaultCoverImage($classified);
        }

        return $classifieds;
    }
}
