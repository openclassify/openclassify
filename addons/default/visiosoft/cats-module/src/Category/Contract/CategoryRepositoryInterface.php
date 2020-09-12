<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CategoryRepositoryInterface extends EntryRepositoryInterface
{
    public function deleteSubCategories($id);

    public function deleteCategories($id);

    public function skipAndTake($take, $skip);

    public function getParents($id);

    public function getSubCategories($id);

    public function getMainCategories();

    public function getCategoryTextSeo($categories);

    public function setQuerySearchingAds($query, $category);

    public function searchKeyword($keyword, $selected = null);
}
