<?php
namespace Visiosoft\CatsModule\Category\Command;

use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class getCategoriesLevel2
{
    public function handle(CategoryRepositoryInterface $repo)
    {
        return $repo->getCategoriesLevel2();
    }
}
