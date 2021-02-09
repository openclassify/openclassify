<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CategoryRepositoryInterface extends EntryRepositoryInterface
{
    public function findById($id);

    public function mainCats();

    public function getItem($cat);

    public function getCatById($id);

    public function getSubCatById($id);

    public function getSingleCat($id);

    public function findBySlug($slug);

    public function getCategories();

    public function DeleteCategories($id);

	public function getMainAndSubCats();
}
