<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CategoryRepositoryInterface extends EntryRepositoryInterface
{
    public function getMainCategories();

    public function getCategoriesLevel2();

    public function getCategoryById($id);

    public function getSubCatById($id);

    public function findBySlug($slug);

    public function getParentCategoryById($id);

    public function getParentCategoryByOrder($id);

    public function getLevelById($id);

    public function getDeletedCategories();

	public function getMainAndSubCats();
}
