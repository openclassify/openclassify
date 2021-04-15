<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CategoryCollection extends EntryCollection
{

    public function getMainCategories()
    {
        $category_repository = app(CategoryRepositoryInterface::class);
        return $category_repository->getMainCategories();
    }
}
