<?php
namespace Visiosoft\CatsModule\Category\Command;

use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class getLevel2Cats
{
    public function handle(CategoryRepositoryInterface $repo)
    {
        return $repo->getLevel2Cats();
    }
}
