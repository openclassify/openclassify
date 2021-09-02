<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;

class LatestClassifieds
{

    /**
     * @param ClassifiedRepositoryInterface $groups
     * @return |null
     */
    public function handle(ClassifiedRepositoryInterface $classifiedRepository)
    {
        return $classifiedRepository->latestClassifieds();
    }
}
