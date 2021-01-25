<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CategoryPresenter extends EntryPresenter
{
    public function getCategoryName($id)
    {
        $category = $this->find($id);
        return $category->name;
    }

    public function getParentCategoryById($id)
    {
        $category_repository = app(CategoryRepositoryInterface::class);
        return $category_repository->getParentCategoryById($id);
    }
}
